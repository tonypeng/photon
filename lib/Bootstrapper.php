<?php
require_once __DIR__.'/globals.php';
require_once __DIR__.'/ClassLoader.php';
require_once __DIR__.'/Photon.php';

class Bootstrapper
{
    public static function run()
    {
        // register autoloader
        ClassLoader::register();

        // run our front controller
        Photon::run();
    }
}
