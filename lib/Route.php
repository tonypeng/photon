<?php

class Route {

    const ROUTE_COMPILE_ROUTE_VAR_PATTERN = '/\\\{([A-Za-z0-9_]+?)\\\}/';

    private $_pattern;
    private $_predicates;

    private $_compiled;

    public function __construct($pattern) {
        $this->_pattern = $pattern;
        $this->_predicates = [];

        $this->_compiled = null;
    }

    public function where($varName) {
        invariant(is_string($varName));

        $route_pred = new RoutePredicate($this, $varName);

        invariant(!isset($this->_predicates[$varName]), 'A predicate bound to %s already exists.', $varName);

        $this->_predicates[$varName] = $route_pred;

        return $route_pred;
    }

    public function compile() {
        $escaped = preg_quote($this->_pattern, '/');
        $escaped = '^'.$escaped.'$';

        $this->_compiled = preg_replace_callback(self::ROUTE_COMPILE_ROUTE_VAR_PATTERN,
            function($matches) {
                invariant(count($matches) >= 2);

                $var_name = $matches[1];

                return (isset($this->_predicates[$var_name])) ? $this->_predicates[$var_name]->compile()
                    : '(?<'.$var_name.'>'.RoutePredicate::DEFAULT_PATTERN.')';
            },
            $escaped
        );

        return $this->_compiled;
    }

    public function __toString() {
        return $this->_compiled ?: $this->compile().''; // hack because PHP can't determine types
    }
}

class RoutePredicate {

    const DEFAULT_PATTERN = '[A-Za-z0-9_]+';

    private $_route;
    private $_var_name;
    private $_pattern;

    public function __construct(Route $route, $varName) {
        $this->_route = $route;
        $this->_var_name = $varName;
        $this->_pattern = self::DEFAULT_PATTERN;
    }

    public function matches($pattern) {
        $this->_pattern = $pattern;
        return $this;
    }

    public function integer() {
        $this->_pattern = '[0-9]+';
        return $this;
    }

    public function number() {
        $this->_pattern = '[0-9]+(?:\.[0-9]+)?';
        return $this;
    }

    public function string() {
        $this->_pattern = '.+';
        return $this;
    }

    public function boolean() {
        $this->_pattern = '(?i)true|false|on|off|yes|no(?-i)';
        return $this;
    }

    public function end() {
        return $this->_route;
    }

    public function compile() {
        return '(?<'.$this->_var_name.'>'.$this->_pattern.')';
    }
}