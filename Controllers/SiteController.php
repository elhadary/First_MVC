<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Core\Request;

class SiteController extends Controller
{
    public static function home()
    {
        $params = [
            'title' => 'homepage'
        ];
        (new SiteController)->render('home',$params);
    }
    // If method doesn't Exist
    public static function __callStatic(string $method, array $parameters){
        return self::home();
    }

}