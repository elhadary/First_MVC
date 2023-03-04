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
    public static function getLogin()
    {
        (new SiteController)->render('login');
    }
    public static function postLogin()
    {
        $errors = [];
        $data = (new Request)->getPostData();
        if($data['email'] == '')
        {
            $errors[] = 'Please enter an email';
        }
        if ($data['password'] == '')
        {
            $errors[] = 'Please enter a password';
        }
        (new SiteController)->render('login',[],$errors);
    }

    // If method doesn't Exist
    public static function __callStatic(string $method, array $parameters){
        return self::home();
    }

}