<?php

namespace app\Core;

class Router
{
    public Request $request;
    public Response $response;
    public array $routes = [];
    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    public function get($path,$callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path,$callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false)
        {
            $layout = $this->renderLayout();
            $content = $this->renderView('_404');
            $this->response->setErrorCode(404);
            echo str_replace("{{content}}",$content,$layout);
        }else
        {
            return call_user_func($callback);
        }
    }

    public function render($view)
    {
        $layout = $this->renderLayout();
        $content = $this->renderView($view);
        return str_replace("{{content}}",$content,$layout);
    }
    public function renderLayout()
    {
        ob_start();
        include dirname(__DIR__).'/Views/layouts/main.php';
        return ob_get_clean();
    }

    public function renderView($view)
    {
        ob_start();
        include dirname(__DIR__)."/Views/$view.php";
        return ob_get_clean();
    }
}