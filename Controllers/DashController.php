<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Core\Session;
use app\Models\Post;


class DashController extends Controller
{

    public function dashboard(){
        $this->isUser();
        $posts = new Post();
        $posts = $posts->select()->fetchAll();
        $this->render('dashboard',$posts);
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