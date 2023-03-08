<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Models\Post;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'title' => 'homepage'
        ];
        $posts = new Post();
        $posts = $posts->select()->fetchAll();
        isset($_SESSION['username']) ? $this->render('dashboard',$posts) : $this->render('home',$posts);

    }

    public function post()
    {
        $data = $this->request->getUrlData();
        $post = new Post();
        $post = $post->select()->where('id','=',$data['id'])->fetchAll();
        if(!empty($post))
        {
            $GLOBALS['post'] = $post;
            return $this->render('post');
        }
        return header('LOCATION: /');
    }
    // If method doesn't Exist
    public function __call(string $method, array $parameters){
        return self::home();
    }

}