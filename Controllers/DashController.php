<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Core\Session;


class DashController extends Controller
{

    public function dashboard(){
        $this->isUser();
        return $this->render('dashboard');
    }


    public function isUser()
    {
        if (!isset($_SESSION['username'])) {
            header('LOCATION: /login');
            die();
        }
    }

    public function logout()
    {
        $session = new Session();
        $session->destroy();
        header("Location: /login");
    }

}