<?php

class Http404Controller extends Controller
{
    public static function getURL()
    {
        return 'index.php';
    }

    public static function getParams()
    {

    }

    public function render()
    {
        return '404 Not Found! :(';
    }
}
