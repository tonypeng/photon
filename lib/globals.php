<?php
function invariant()
{
    $args = func_get_args();
    $cond = array_shift($args);
    $msg = array_shift($args);

    if(!$cond) {
        $msg = vsprintf($msg, $args);
        throw new InvariantViolationException($msg);
    }
}

function is_str_boolean($test)
{
    static $bools = array('true', 'false'); // lets us reuse $bools

    return in_array(mb_strtolower($test), $bools);
}

function strtob($str)
{
    return mb_strtolower($str) === 'true';
}

function join_paths()
{
    $paths = array();

    foreach (func_get_args() as $arg) {
        if ($arg !== '') { $paths[] = $arg; }
    }

    return preg_replace('#/+#','/', join('/', $paths));
}

function ph_mb_charat($haystack, $pos)
{
    $chars = preg_split('//u', $haystack, -1, PREG_SPLIT_NO_EMPTY);

    return $chars[$pos];
}

require_once __DIR__.'/InvariantViolationException.php';
require_once __DIR__.'/philter/phtml/phtml_globals.php';
