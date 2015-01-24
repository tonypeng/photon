<?php
if(php_sapi_name() !== "cli") {
    die();
}

$verbose = true;
$fileName;
$tablevel

if(count($argv) < 2) {
    die('No file to compile.  `photon compile` requires a file argument.');
}

if(count($argv) > 2) {
    
    if($argv[0] == 'quiet') {
        $verbose = false;
        $fileName = argv[1];
        $tablevel = argv[2];
    }
    else{
        $fileName = $argv[0];
        $tablevel = $argv[1];
    }
    
}

$file = fopen($fileName, "r+");

printf($tablevel."Processing file: %s\n", $file->getFileName());

$classes = getPHPClasses($file->getPathname());

foreach($classes as $class => $details) {
$filepath = $path.'/'.$file->getFileName();

processClassmap($class, $filepath);
processController($class, $details, $filepath);

function println()
{
    global $verbose;

    if(!$verbose) return;

    $args = func_get_args();
    $var  = array_shift($args);
    $s    = vsprintf($var, $args);

    printf($s . "\n");
}

