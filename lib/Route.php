<?php

class RouteVariable {
    private $_var_name;

    public function __construct($var_name) {
        $this->_var_name = $var_name;
    }

    public function getName() {
        return $this->_var_name;
    }

    public function validate($value) {
        return true; // TODO: implement validation
    }
}