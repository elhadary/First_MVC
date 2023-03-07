<?php
require dirname(__DIR__).'/vendor/autoload.php';

use app\Core\Application;
use app\Controllers\SiteController;
use app\Controllers\UsersController;


$app = new Application();

$app->router->get('/',[SiteController::class,'home']);
$app->router->get('/contact',[SiteController::class,'contact']);
$app->router->get('/login',[UsersController::class,'getLogin']);
$app->router->post('/login',[UsersController::class,'postLogin']);
$app->router->get('/register',[UsersController::class,'getRegister']);
$app->router->post('/register',[UsersController::class,'postRegister']);


$app->run();