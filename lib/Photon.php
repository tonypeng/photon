<?php
require_once __DIR__.'/Request.php';
require_once __DIR__ . '/Controller.php';

class Photon
{
    const DEFAULT_URL = 'index.php';
    const NOT_FOUND_URL = '404';

    public static function run()
    {
        require_once __DIR__.'/__autogen/urimap.php';

        invariant(isset($PHOTON__urimap), 'URI map not found. Did you build?');
        invariant(is_object($PHOTON__urimap) && $PHOTON__urimap instanceof HashMap, 'Invalid URI map.');

        $url = self::getRequestURL();
        $responder = self::getControllerForRequest($PHOTON__urimap, $url);

        $controller_name = $responder[0];
        $params = $responder[1];

        $request = Request::fromRequest();

        foreach ($params as $key => $val) {
            $request->set($key, $val);
        }

        $controller = new $controller_name($request);

        $invalidity = $controller->invalid();

        invariant(!$invalidity, 'Controller failed validity test: '.$invalidity);

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

    private static function getRequestURL()
    {
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

    private static function getControllerForRequest($uri_map, $req_url) {

        $uri_map_keys = $uri_map->keys();

        foreach($uri_map_keys as $uri) {
            $controller = $uri_map[$uri];

            $route = (is_object($uri) && $uri instanceof Route) ? $uri : new Route($uri.'');

            $pattern = '/'.$route->compile().'/';

            $matches = [];

            if (preg_match($pattern, $req_url, $matches)) {
                return array($controller, $matches);
            }
        }

        return array($uri_map[self::NOT_FOUND_URL], []);
    }
}
