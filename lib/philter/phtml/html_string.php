<?php

class html_string extends PhilterHtml {
    private $_string;

    public function __construct($string) {
        $this->_string = $string;

        parent::__construct(array());
    }

    public function renderHtml($children) {
        return htmlspecialchars($this->_string, ENT_QUOTES, 'UTF-8');
    }

    protected function getTag() { return ''; }
}