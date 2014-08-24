<?php
class PhotonRedirectException extends Exception
{
    $url;
    $message;
    public function __construct($url, $message="")
    {
      this->url=$url;
      this->message = $message;
    }
}
