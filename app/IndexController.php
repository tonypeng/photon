<?php

class IndexController extends Controller
{
    public static function getURL()
    {
        return 'index.php';
    }

    public static function getParams()
    {

    }

    public function render()
    {
        return \ph\div(["style" => "background-color: #eee; font-family: sans-serif"],
            'Hello, world!', \ph\br(),
            \ph\p([],
                'Welcome to Photon!'
            )
        );
    }
}
