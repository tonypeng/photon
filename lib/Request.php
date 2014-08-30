<?php

class Request
{
    const TYPE_INT = 'int';
    const TYPE_STRING = 'string';
    const TYPE_NUMBER = 'number';
    const TYPE_BOOL = 'bool';

    const GET = 'GET';
    const POST = 'POST';

    public static function fromRequest() {
        $params = array();

        switch ($_SERVER['REQUEST_METHOD']) {
            case self::GET:
                $params = $_GET;
                break;
            case self::POST:
                $params = $_POST;
                break;
        }

        return self::from($_SERVER['REQUEST_METHOD'], $params);
    }

    public static function from($method, $params)
    {
        return new Request($method, $params);
    }

    private $_method;
    private $_params;

    private $_expects;

    private function __construct($method, $params)
    {
        $this->_method = $method;
        $this->_params = $params;

        $this->_expects = array();
    }

    public function getMethod()
    {
        return $this->_method;
    }

    public function expect($expects)
    {
        foreach($expects as $param => $props) {
            invariant(array_key_exists('required', $props)
                && array_key_exists('type', $props),
                'Expect %s had invalid props.',
                $param
            );

            if($props['required']) {
                invariant(array_key_exists($param, $this->params),
                    'Expected %s, but it didn\'t exist.',
                    $param
                );
            }

            if(array_key_exists($param, $this->_params)) {
                $val = $this->_params[$param];

                switch($props['type']) {
                    case self::TYPE_INT:
                        invariant(ctype_digit($val), 'Invalid type for param %s (expected int, got %s).', $param, $val);
                        break;
                    case self::TYPE_STRING:
                        // anything can be string-ified, so no checks here
                        break;
                    case self::TYPE_NUMBER:
                        invariant(is_numeric($val), 'Invalid type for param %s (expected number, got %s).', $param, $val);
                        break;
                    case self::TYPE_BOOL:
                        invariant(
                            in_array(mb_strtolower($val), array('true', 'false')),
                            'Invalid type for param %s (expected bool, got %s).',
                            $param,
                            $val
                        );
                        break;
                }
            }

            $this->_expects[$param] = array('required' => $props['required'], 'type' => $props['type']);
        }

        return $this;
    }

    public function getInt($param_name)
    {
        if($this->_expects) {
            // validate the param name
            invariant(array_key_exists($param_name, $this->_expects),
                'Requested unexpected int param %s.',
                $param_name
            );
        }

        if(!array_key_exists($param_name, $this->_params)) {
            return null;
        }

        $res = $this->_params[$param_name];

        if(!ctype_digit($res)) {
            return null;
        }

        return $res;
    }

    public function getString($param_name)
    {
        if($this->_expects) {
            // validate the param name
            invariant(array_key_exists($param_name, $this->_expects),
                'Requested unexpected string param %s.',
                $param_name
            );
        }

        if(!array_key_exists($param_name, $this->_params)) {
            return null;
        }

        $res = $this->_params[$param_name];

        return $res . '';
    }

    public function getBool($param_name)
    {
        if($this->_expects) {
            // validate the param name
            invariant(array_key_exists($param_name, $this->_expects),
                'Requested unexpected bool param %s.',
                $param_name
            );
        }

        if(!array_key_exists($param_name, $this->_params)) {
            return null;
        }

        $res = $this->_params[$param_name];

        if(!is_str_boolean($res))
            return null;

        return strtob($res);
    }

    public function getNumber($param_name)
    {
        if($this->_expects) {
            // validate the param name
            invariant(array_key_exists($param_name, $this->_expects),
                'Requested unexpected number param %s.',
                $param_name
            );
        }

        if(!array_key_exists($param_name, $this->_params)) {
            return null;
        }

        $res = $this->_params[$param_name];

        if(!is_numeric($res))
            return null;

        return strtob($res);
    }
}
