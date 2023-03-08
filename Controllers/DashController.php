<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Core\Session;


class DashController extends Controller
{

    public function dashboard(){
        if(isset($_SESSION['username'])){
            (new SiteController)->render('dashboard');
        }else{
            header("Location: /login");
        }
    }

    public function logout()
    {
        $session = new Session();
        $session->destroy();
        header("Location: /login");
    }

}