<?php

interface IController {

    /**
     * @return string
     */
    public static function getURL();

    /**
     * @return array
     */
    public static function getParams();

    public function render();
}