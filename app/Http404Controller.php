<?php

class Http404Controller extends SiteController
{
    public static function getURL()
    {
        return '404';
    }

    public function render()
    {
        return '404 Not Found! :(';
    }
}
