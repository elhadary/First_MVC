<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Core\Request;
use app\models\User;

class UsersController extends Controller
{
    public static function getLogin()
    {
        (new SiteController)->render('login');
    }

    public static function postLogin()
    {
        $errors = [];
        $data = (new Request)->getPostData();
        if($data['username'] == '')
        {
            $errors[] = 'Please enter an email';
        }
        if ($data['password'] == '')
        {
            $errors[] = 'Please enter a password';
        }
        $user = new User();
        $user = $user->select()->where('username','=',$data['username'])->fetchAll();
        if(!empty($user))
        {
           if($user[0]['password'] == $data['password'])
           {
               $errors[] = 'correct';
               (new SiteController)->render('login',['error'=> '<div class="alert alert-success" role="alert">Correct</div>']);
           }else
           {
               $errors[] = 'password is not correct';
               (new SiteController)->render('login',[],$errors);
           }
        }else
        {
            $errors[] = 'Username is wrong';
            (new SiteController)->render('login',[],$errors);
        }


    }

    public static function getRegister()
    {
        (new SiteController)->render('register');
    }

    public static function postRegister()
    {
        $errors = [];
        $data = (new Request)->getPostData();
        if($data['username'] == '')
        {
            $errors[] = 'Please enter a username';
        }
        if ($data['password'] == '')
        {
            $errors[] = 'Please enter a password';
        }
        if(!preg_match("/^[a-z\d_]{5,40}$/i",$data['username']) OR str_contains($data['password'],' ' OR str_contains($data['username'],' ')))
        {
            (new SiteController)->render('register',['error' => '<div class="alert alert-danger" role="alert">Please Enter a valid username and password</div>']);
            die();
        }
        if(count($errors) === 0)
        {
            $user = new User();
            $user->insert(['username' => $data['username'],'password' => $data['password']]);
            $user->execute();
            if ($user->error == '')
            {
                $success = '<div class="alert alert-success" role="alert">User Registered Successfully</div>';
                (new SiteController)->render('register',['error' => $success]);
                die();
            }else
            {
                (new SiteController)->render('register',['error' => $user->error]);
                die();
            }
        }
        (new SiteController)->render('register',[],$errors);
    }

    // If method doesn't Exist
    public static function __callStatic(string $method, array $parameters){
        return self::getLogin();
    }

}