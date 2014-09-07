<?php

abstract class Controller
{
    private $_request;

    public function __construct(Request $request) {
        $this->_request = $request;
    }

    /**
     * @return string
     */
    public static function getURL() {
        return '';
    }

    /**
     * @return array
     */
    public static function getParams() {
        return array();
    }

    protected function getRequest() {
        return $this->_request;
    }

    public abstract function render();
}
