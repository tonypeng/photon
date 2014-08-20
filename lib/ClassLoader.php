<?php

/**
 * Automatically loads classes from the generated classmap.
 */
class ClassLoader {
    public static function register() {
        $classmap_file = join_paths(__DIR__, '__autogen/classmap.php');

        invariant(file_exists($classmap_file), 'Classmap not found. Did you build?');

        require_once($classmap_file);

        spl_autoload_register(function($class) use($PHOTON__classmap) {
            if(isset($PHOTON__classmap[$class])) {
                $path = join_paths(__DIR__, '..', $PHOTON__classmap[$class]);

                require_once($path);
            }
        });
    }
}