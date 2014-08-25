<?php
class PhotonRedirectException extends Exception
{
    private $url;
    private $message;
    public function __construct($url, $message='')
    {
        this->url=$url;
        this->message = $message;
    }

    public function getURL()
    {
        return this->$url;
    }
}
