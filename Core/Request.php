<?php

namespace app\Core;

class Request
{
    public function getPath()
    {
        $uri = $_SERVER['REQUEST_URI'];
        if($uri == '/')
        {
            return $uri;
        }elseif(str_contains($uri,'?')) {
            $pos = strpos($uri,'?');
            return substr($uri,0,$pos);
        }else{
            return $uri;
        }
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getPostData()
    {
        return $_POST;
    }
    public function getUrlData()
    {
        return $_GET;
    }

}