<?php
class PhotonRedirectException extends Exception
{
    private $_url;
    private $_message;

    public function __construct($url, $message='')
    {
        this->_url = $url;
        this->_message = $message;
    }

    public function getURL()
    {
        return this->$_url;
    }
}
