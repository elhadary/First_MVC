<?php

namespace app\Controllers;

use app\Core\Controller;

class SiteController extends Controller
{
    public static function home()
    {
        (new SiteController)->render('home');
    }

    // If method doesn't Exist
    public static function __callStatic(string $method, array $parameters){
        return self::home();
    }

}