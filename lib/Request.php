<?php

class Request
{
    const TYPE_INT = 'int';
    const TYPE_STRING = 'string';
    const TYPE_NUMBER = 'number';
    const TYPE_BOOL = 'bool';
    const TYPE_ANY = 'any';

    const GET = 'GET';
    const POST = 'POST';

    public static function fromRequest() {
        $params = array_merge($_GET, $_POST);

        return self::from($_SERVER['REQUEST_METHOD'], $params, $_COOKIE);
    }

    public static function from($method, $params, $cookies)
    {
        return new Request($method, $params, $cookies);
    }

    private $_method;
    private $_params;
    private $_cookies;

    private $_expects;

    private function __construct($method, $params, $cookies)
    {
        $this->_method = $method;
        $this->_params = $params;
        $this->_cookies = $cookies;

        $this->_expects = array();
    }

    public function set($key, $val) {
        invariant($this->validateSetParamWithExpect($key, $val),
            'Requested unexpected int param %s.',
            $key
        );

        $this->_params[$key] = $val;
    }

    public function getMethod()
    {
        return $this->_method;
    }

    private function validateSetParamWithExpect($key, $val) {
        if($this->_expects) {
            // validate the param name
            if(!array_key_exists($key, $this->_expects)) {
                return false;
            }

            $props = $this->_expects[$key];

            if(!$props['required'] && $val == null) {
                return true;
            }

            switch($props['type']) {
                case self::TYPE_INT:
                    return ctype_digit($val);
                case self::TYPE_STRING:
                    return true;
                case self::TYPE_NUMBER:
                    return is_numeric($val);
                case self::TYPE_BOOL:
                    return in_array(mb_strtolower($val), array('true', 'false'));
            }

            return true;
        }

        return true;
    }

    private function validateGetParamWithExpect($key, $type) {
        if($this->_expects) {
            // validate the param name
            if(!array_key_exists($key, $this->_expects)) {
                return false;
            }

            $props = $this->_expects[$key];

            return $props['type'] == $type;
        }

        return true;
    }

    public function expect($expects)
    {
        $this->_expects = [];

        foreach($expects as $param => $props) {
            invariant(array_key_exists('required', $props)
                && array_key_exists('type', $props),
                'Expect %s had invalid props.',
                $param
            );

            if($props['required']) {
                invariant(array_key_exists($param, $this->_params),
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
        invariant($this->validateGetParamWithExpect($param_name, self::TYPE_INT),
            'Requested unexpected bool param %s.',
            $param_name
        );

        if(!array_key_exists($param_name, $this->_params)) {
            return null;
        }

        $res = $this->_params[$param_name];

        if(!ctype_digit($res)) {
            return null;
        }

        return $res+0;
    }

    public function getString($param_name)
    {
        invariant($this->validateGetParamWithExpect($param_name, self::TYPE_STRING),
            'Requested unexpected string param %s.',
            $param_name
        );

        if(!array_key_exists($param_name, $this->_params)) {
            return null;
        }

        $res = $this->_params[$param_name];

        return $res . '';
    }

    public function getBool($param_name)
    {
        invariant($this->validateGetParamWithExpect($param_name, self::TYPE_BOOL),
            'Requested unexpected bool param %s.',
            $param_name
        );

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
        invariant($this->validateGetParamWithExpect($param_name, self::TYPE_NUMBER),
            'Requested unexpected number param %s.',
            $param_name
        );

        if(!array_key_exists($param_name, $this->_params)) {
            return null;
        }

        $res = $this->_params[$param_name];

        if(!is_numeric($res))
            return null;

        return $res + 0.0;
    }

    public function hasCookie($name) {
        return isset($this->_cookies[$name]);
    }

    public function cookie($name) {
        if(!$this->hasCookie($name)) {
            return null;
        }

        return $this->_cookies[$name];
    }
}
