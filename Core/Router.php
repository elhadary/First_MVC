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
            return str_replace("{{content}}",$content,$layout);
        }
        return call_user_func($callback);
    }

    public function render($view,$params,$errors)
    {
        extract($params);
        $layout = $this->renderLayout();
        $content = $this->renderView($view);
        $content =  str_replace("{{content}}",$content,$layout);
        return $this->renderVariables($content,$params,$errors);
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
    public function renderErrors($content,$errors)
    {
        $string = '';
        if(str_contains($content,"{{errors}}"))
        {
            foreach ($errors as $error)
            {
                $string .= '<div class="alert alert-danger" role="alert">'.$error.'</div>';
            }
        }
        return str_replace("{{errors}}",$string,$content);
    }
    // Find all {{Variable}} and render it then delete unfounded variables
    public function renderVariables($content,$params,$errors)
    {
        $content = $this->renderErrors($content,$errors);
        extract($params);
        while (str_contains($content,"{{"))
        {
            $firstPos = strpos($content,"{{");
            $secondPos = strpos($content,"}}");
            $length = abs($secondPos - $firstPos);
            $var = trim(substr($content,$firstPos,$length),'{');
            if(array_key_exists($var,get_defined_vars())) {
                $content = str_replace("{{".$var."}}",get_defined_vars()[$var],$content);
            }else{
                $content = str_replace("{{".$var."}}",'',$content);
            }
        }return $content;
    }
}