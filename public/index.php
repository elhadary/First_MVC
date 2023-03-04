<?php
require dirname(__DIR__).'/vendor/autoload.php';

use app\Core\Application;
use app\Controllers\SiteController;

$app = new Application();

$app->router->get('/',[SiteController::class,'home']);
$app->router->get('/contact',[SiteController::class,'contact']);
$app->router->get('/login',[SiteController::class,'getLogin']);
$app->router->post('/login',[SiteController::class,'postLogin']);


$app->run();