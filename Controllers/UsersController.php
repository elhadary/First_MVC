<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Core\Request;
use app\Core\Session;
use app\models\User;

class UsersController extends Controller
{
    public function getLogin()
    {
        $this->isUser();
        var_dump($_SESSION);
        $this->render('login');
    }

    public function postLogin()
    {
        $this->isUser();
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
        $user = new User();
        $user = $user->select()->where('username','=',$data['username'])->fetchAll();
        if(!empty($user))
        {
           if($user[0]['password'] == $data['password'])
           {
               $session = new Session();
               $session->login($data['username'],$user[0]['id']);
               header("LOCATION: /dashboard");
           }else
           {
               $errors[] = 'password is not correct';
               $this->render('login',[],$errors);
           }
        }else
        {
            $errors[] = 'Username is wrong';
            $this->render('login',[],$errors);
        }


    }

    public function getRegister()
    {
        $this->isUser();
        $this->render('register');
    }

    public function postRegister()
    {
        $this->isUser();
        $errors = [];
        $data = (new Request)->getPostData();
        $user = new User();
        $exist = $user->select()->where('username', '=',$data['username']);
        $exist = $exist->fetchAll();

        if(!preg_match("/^[a-z\d_]{5,40}$/i",$data['username']) OR str_contains($data['password'],' ' OR str_contains($data['username'],' ')))
        {
            $errors[] = 'Please Enter a valid username and password';

        }
        if(isset($exist[0]['username']) && $exist[0]['username'] == $data['username'])
        {
            $errors[] = 'Username already exists';
        }
        if(count($errors) === 0)
        {
            $user->insert(['username' => $data['username'],'password' => $data['password']]);
            $user->execute();
            if ($user->error == '')
            {
                $success = '<div class="alert alert-success" role="alert">User Registered Successfully</div>';
                $this->render('register',['success' => $success]);
                die();
            }else
            {
                $this->render('register',[],$errors);
                die();
            }
        }
        $this->render('register',[],$errors);
    }

    public function isUser()
    {
        if(isset($_SESSION['username']))
        {
            header("LOCATION: /dashboard");
            die();
        }else
        {
            return false;
        }
    }

    // If method doesn't Exist
    public function __call(string $method, array $parameters){
        return self::getLogin();
    }

}