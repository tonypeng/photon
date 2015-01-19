<?php

class RequestParameter {
    private $_name;
    private $_type = Request::TYPE_ANY;
    private $_required = false;

    public function __construct($name) {
        $this->_name = $name;
    }

    public function int() {
        $this->_type = Request::TYPE_INT;

        return $this;
    }

    public function bool() {
        $this->_type = Request::TYPE_BOOL;

        return $this;
    }

    public function number() {
        $this->_type = Request::TYPE_NUMBER;

        return $this;
    }

    public function string() {
        $this->_type = Request::TYPE_STRING;

        return $this;
    }

    public function required() {
        $this->_required = true;

        return $this;
    }

    public function getType() {
        return $this->_type;
    }

    public function isRequired() {
        return $this->_required;
    }

    public function toArray() {
        return [
            $this->_name,
            [
                'type' => $this->_type,
                'required' => $this->_required,
            ]
        ];
    }
}