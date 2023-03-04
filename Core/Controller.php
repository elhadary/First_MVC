<?php

namespace app\Core;

class Controller
{
    public Application $app;
    public function __construct()
    {
        $this->app = new Application();
    }

    public static function Root()
    {
        return dirname(__DIR__);
    }

    public function render($view)
    {
       echo $this->app->router->render($view);
    }
}