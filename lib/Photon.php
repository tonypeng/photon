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

        $url = self::getRequestURL();
        $responder = self::getControllerForRequest($PHOTON__urimap, $url);

        $controller_name = $responder[0];
        $params = $responder[1];

        $request = Request::fromRequest();

        foreach ($params as $key => $val) {
            $request->set($key, $val);
        }

        $controller = new $controller_name($request);

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
        $uri_parts = explode('/', $req_url);

        // TODO: this is a quick hack; switch to regex and use OOP later
        // Have photon build compile URLs to regex expressions that we can quickly match in this method
        foreach($uri_map as $uri => $controller) {
            $parameters = array();

            $pattern_parts = explode('/', $uri);

            if(count($uri_parts) != count($pattern_parts)) continue;

            $found = true;

            for($i = 0; $i  < count($pattern_parts); $i++) {
                $pattern_part = $pattern_parts[$i];
                $uri_part = $uri_parts[$i];

                if(mb_substr($pattern_part, 0, 1) == '{' && mb_substr($pattern_part, mb_strlen($pattern_part) - 1) == '}') {
                    $var_name = mb_substr($pattern_part, 1, mb_strlen($pattern_part) - 2);

                    $parameters[$var_name] = $uri_part;
                } else {
                    if($uri_part != $pattern_part) {
                        $found = false;
                        break;
                    }
                }
            }

            if($found) {
                return array($controller, $parameters);
            }
        }

        return array($uri_map[self::NOT_FOUND_URL], []);
    }
}
