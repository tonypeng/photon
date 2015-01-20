<?php
if(php_sapi_name() !== "cli") {
    die();
}

$verbose = true;

if(count($argv) < 2) {
    die('No file to compile.  `photon compile` requires a file argument.');
}

if(count($argv) > 2) {
    foreach($argv as $arg) {
        if($arg == 'quiet') {
            $verbose = false;
        }
    }
}

function println()
{
    global $verbose;

    if(!$verbose) return;

    $args = func_get_args();
    $var  = array_shift($args);
    $s    = vsprintf($var, $args);

    printf($s . "\n");
}

