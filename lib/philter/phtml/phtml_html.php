<?php

class phtml_html extends PhilterHtml {
    private $_string;

    public function __construct($string) {
        $this->_string = $string;

        parent::__construct(array());
    }

    public function renderHtml($children) {
        return $this->_string;
    }

    protected function getTag() { return ''; }
}