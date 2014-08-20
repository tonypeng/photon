<?php

class IndexController implements IController {
    public static function getURL() {
        return 'index.php';
    }

    public static function getParams() {

    }

    public function render() {
        return 'Hello, world!';
    }
}