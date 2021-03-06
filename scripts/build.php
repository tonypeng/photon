<?php
if(php_sapi_name() !== "cli") {
    die();
}

$start_time = microtime(true);

require __DIR__ . "/common.php";

printf("Running photon build...\n");
printf("Version 1.0\n");
printf("\n");

if(!file_exists("lib") || !file_exists("app") || !file_exists("public")) {
    printerr("Photon build must be run from photon root.");
    printResult(false);
}

$classmap = array();
$urimap = array();

printf("Starting step 1: processing files\n");

iterateDirectory("", "  ");

printf("\n");
printf("Writing files...\n");

writeFiles();

printResult();

function iterateDirectory($path, $tablevel="")
{
    $temp_path = $path === '' ? '.' : $path;
    $iter = new DirectoryIterator($temp_path);

    $subdirs = array();

    foreach ($iter as $file) {
        if($file->isDot() || substr($file->getFileName(), 0, 1) === '.') {
            continue;
        }

        if($file->isDir()) {
            if($file->getFileName() === '__autogen'
                || $file->getFileName() === 'scripts') continue; // skip autogens

            $subdirs[] = $file->getFileName();

            continue;
        } else {
            if($file->getExtension() != 'php') continue;

            // normal file
            printf($tablevel."Processing file: %s\n", $file->getFileName());

            $classes = getPHPClasses($file->getPathname());

            foreach($classes as $class => $details) {
                $filepath = $path.'/'.$file->getFileName();

                processClassmap($class, $filepath);
                processController($class, $details, $filepath);
            }
        }
    }

    foreach($subdirs as $subdir) {
        printf($tablevel."Entered new directory: %s\n", $subdir);

        iterateDirectory(join_paths($path,$subdir), $tablevel . "  ");
    }
}

function writeFiles()
{
    global $classmap;

    $classmap_out =
        "<?php\n// classmap.php - Autogenerated by Photon build.\n// Do not edit!\n\n\$PHOTON__classmap = " . var_export($classmap, true) . ";";

    printf("  Writing classmap...\n");
    if(!file_put_contents("lib/__autogen/classmap.php", $classmap_out)) {
        printResult(false);
    }
}

function processClassmap($class, $file)
{
    global $classmap;

    if(isset($classmap[$class])) {
        printerr('Class conflict %s', $class);
        printResult(false);
    }

    $classmap[$class] = $file;
}

function processController($class, $details, $file)
{
    global $urimap;

    if($details['impl'] == 'Controller') {
        // TODO
    }
}

function getPHPClasses($file)
{
    $code = file_get_contents($file);

    $classes = array();
    $lastclass = '';
    $tokens = token_get_all($code);
    $count = count($tokens);
    for ($i = 2; $i < $count; $i++) {
        if ($tokens[$i - 2][0] == T_CLASS
            && $tokens[$i - 1][0] == T_WHITESPACE
            && $tokens[$i][0] == T_STRING) {

            $class_name = $tokens[$i][1];
            $lastclass = $class_name;
            $classes[$class_name] = array('impl' => '', 'ext' => '');
        }

        if($tokens[$i - 2][0] == T_IMPLEMENTS
            && $tokens[$i - 1][0] == T_WHITESPACE
            && $tokens[$i][0] == T_STRING) {
            $implements = $tokens[$i][1];

            $classes[$lastclass]['impl'] = $implements;
        }

        if($tokens[$i - 2][0] == T_EXTENDS
            && $tokens[$i - 1][0] == T_WHITESPACE
            && $tokens[$i][0] == T_STRING) {
            $implements = $tokens[$i][1];

            $classes[$lastclass]['ext'] = $implements;
        }
    }

    return $classes;
}

function printerr()
{
    $args = func_get_args();
    $var  = array_shift($args);
    $s    = vsprintf($var, $args);

    $s = "ERROR: " . $s;

    $s = ColorCLI::getColoredString($s, "white", "red");

    printf($s . "\n");
}

function printResult($result=true)
{
    global $start_time;
    $end = microtime(true);

    $elapsed = $end - $start_time;
    $elapsed = ((int)($elapsed * 100)) / 100.00;

    printf("\n\n");

    $msg = $result ? "Photon build completed with no errors in ".($elapsed)."s"
        : "Photon build failed after ".($elapsed)."s.";

    if($result) {
        $msg = ColorCLI::getColoredString($msg, "black", "green");
    } else {
        $msg = ColorCLI::getColoredString($msg, "white", "red");
    }

    die($msg);
}
