<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Models\Post;

class PostController extends Controller

{

    public function getPost()
    {
        $this->isUser();
        return $this->render('addPost');
    }
    public function postPost()
    {
        $this->isUser();
        $data = [$_POST['title'],$_POST['text']];
        // VALIDATION
        foreach ($data as $value)
        {
            $value = trim($value,' ');
            if($value == '' or !preg_match('/([\p{L}]+)/u', $value) OR !isset($_POST['title']) OR !isset($_POST['text']))
            {
                $this->render('addPost',[],['error' => 'Please Recheck title and post']);
                die();
            }
        }
        // Adding post
        $post = new Post();
        $title = $_POST['title'];
        $text = $_POST['text'];
        $post->insert(['title' => $title, 'text' => $text,'writer' => $_SESSION['id']]);
        $post->execute();
        if ($post->error == '')
        {
            $success = '<div class="alert alert-success" role="alert">Post added Successfully</div>';
            $this->render('addPost',['success' => $success]);
            die();
        }else
        {
            $this->render('addPost',['error' => $post->error]);
            die();
        }




    }
    public function edit()
    {
        $this->isUser();

        $data = $this->request->getUrlData();
        if(isset($data['id']))
        {
            $post = new Post();
            $post = $post->select()->where('id','=',$data['id'])->fetchAll();
            if(!empty($post))
            {
                ($this->render('editPost',$post[0]));
                die();
            }
        }
        header('LOCATION: /dashboard/posts');

    }
    public function postEdit()
    {
        $this->isUser();

        $data = [$_POST['title'],$_POST['text']];

        foreach ($data as $value)
        {
            $value = trim($value,' ');
            if($value == '' or !preg_match('/([\p{L}]+)/u', $value) OR !isset($_POST['title']) OR !isset($_POST['text']))
            {
                die();
            }
        }

        $post = new Post();
        $update = $post->update(['title' => $_POST['title'],'text' => $_POST['text'],'last_edited' => $_SESSION['id']])->where('id','=',$_POST['id'])->execute();
        if($update) {
            header('LOCATION: /dashboard/edit?id='.$_POST["id"].'&success=1');
        }


    }
    public function delete()
    {
        $this->isUser();
        $data = $this->request->getUrlData();
        $post = new Post();
        $post->delete()->where('id','=',$data['id'])->execute();
        header('LOCATION: /dashboard/posts?success=1');

    }
    public function posts()
    {
        $this->isUser();
        $posts = new Post();
        $posts->select();
        $posts = $posts->fetchAll();
        foreach($posts as $key => $value) {
            $posts[$key]['text'] = substr($value['text'],0,'30').'...';
        }
        ($this->render('posts',['posts' => $posts]));
    }
    public function isUser()
    {
        if (!isset($_SESSION['username'])) {
            header('LOCATION: /login');
            die();
        }
    }

}