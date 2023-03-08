<?php

namespace app\Core;

class Controller
{
    public Application $app;
    public Request $request;
    public function __construct()
    {
        $this->app = new Application();
        $this->request = new Request();
    }

    public static function Root()
    {
        return dirname(__DIR__);
    }

    public function render($view,$params = [],$errors = [])
    {
        $GLOBALS['params'] = $params;
        echo $this->app->router->render($view,$errors);
    }
}