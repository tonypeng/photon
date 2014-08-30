<?php
require_once __DIR__.'/Request.php';
require_once __DIR__.'/IController.php';

class Photon {
    const DEFAULT_URL = 'index.php';
    const NOT_FOUND_URL = '404';

    public static function run() {
        require_once __DIR__.'/__autogen/urimap.php';

        invariant(isset($PHOTON__urimap), 'URI map not found. Did you build?');

        $url = self::getRequestURL();
        if(!isset($PHOTON__urimap[$url])) {
            $url = self::NOT_FOUND_URL;
        }
        invariant(isset($PHOTON__urimap[$url]),
            'URL entry didn\'t exist in the URI map. Check that canonical URIs exist (e.g. index.php, Http404, etc.)'); // wtf?

        $controller_name = $PHOTON__urimap[$url];

        $controller = new $controller_name();

        Response::start();

        try
        {
            echo $controller->render();
        }
        catch(PhotonRedirectException $e)
        {
            header('Location: '. $e->getURL());
            die();
        }

        Response::send();
    }

    private static function getRequestURL() {
        if(!isset($_GET['PHOTON__url'])) {
            return self::DEFAULT_URL;
        }

        $url = mb_strtolower($_GET['PHOTON__url']);
        $len = mb_strlen($url);

        // make sure URL is well formatted
        // 1. no beginning slash
        // 2. no trailing slash

        $start = 0;
        $end = $len - 1;

        if(ph_mb_charat($url, 0) == '/') {
            $start = 1;
        }
        if(ph_mb_charat($url, $end) == '/') {
            $end = $end - 1;
        }

        if($start > $end) {
            return self::DEFAULT_URL;
        }

        if($start > 0 || $end < ($len - 1)) {
            $url = mb_substr($url, $start, ($end - $start) + 1);
        }

        return $url;
    }
}
