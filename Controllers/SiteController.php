<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Core\Request;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'title' => 'homepage'
        ];
        (new SiteController)->render('home',$params);
    }
    // If method doesn't Exist
    public function __call(string $method, array $parameters){
        return self::home();
    }

}