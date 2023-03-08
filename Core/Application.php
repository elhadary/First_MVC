<?php

namespace app\Core;




class Application
{
    public Request $request;
    public Router $router;
    public Response $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router();
        $this->response = new Response();
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}