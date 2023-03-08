<?php

namespace app\Controllers;

use app\Core\Controller;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'title' => 'homepage'
        ];
        isset($_SESSION['username']) ? (new SiteController)->render('dashboard',$params) :(new SiteController)->render('home',$params);

    }
    // If method doesn't Exist
    public function __call(string $method, array $parameters){
        return self::home();
    }

}