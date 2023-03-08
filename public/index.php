<?php
require dirname(__DIR__).'/vendor/autoload.php';

use app\Core\Application;
use app\Controllers\SiteController;
use app\Controllers\UsersController;
use app\Controllers\DashController;

session_start();
$app = new Application();

$app->router->get('/',[SiteController::class,'home']);
$app->router->get('/contact',[SiteController::class,'contact']);
$app->router->get('/login',[UsersController::class,'getLogin']);
$app->router->post('/login',[UsersController::class,'postLogin']);
$app->router->get('/register',[UsersController::class,'getRegister']);
$app->router->post('/register',[UsersController::class,'postRegister']);
$app->router->get('/logout',[DashController::class,'logout']);
$app->router->get('/dashboard',[DashController::class,'dashboard']);




$app->run();