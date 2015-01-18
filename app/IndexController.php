<?php

class IndexController extends SiteController
{
    public static function getURL()
    {
        return 'index.php';
    }

    public function render()
    {
        $var = $this->getRequest()->getInt('test');

        return \ph\div(["style" => "background-color: #eee; font-family: sans-serif"],
            'Hello, world!', \ph\br(),
            \ph\p(['style' => 'font-family: A B C, Comic Sans MS'],
                'Welcome to Photon!'
            )
        );
    }
}
