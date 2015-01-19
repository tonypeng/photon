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

    protected function getRequest() {
        return $this->_request;
    }

    public function invalid() {
        return false;
    }

    public abstract function render();
}
