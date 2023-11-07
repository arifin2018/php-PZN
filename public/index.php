<?php

require_once __DIR__ . '/../vendor/autoload.php';
// require_once(dirname(__FILE__) . "/../app/Apps/router.php");

use Arifin\PHP\MVC\apps\router;
use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\controllers\HomeController;
use Arifin\PHP\MVC\controllers\UserController;
use Arifin\PHP\MVC\Middlewares\AuthMiddleware;
use Arifin\PHP\MVC\Middlewares\GuestMiddleware;
use Arifin\PHP\MVC\Middlewares\LoginMiddleware;

DatabaseApp::getConnection('prod');

router::add('GET','/', HomeController::class, 'index');
router::add('GET','/product/([a-z]*)', HomeController::class, 'product');
router::add('GET','/hello', HomeController::class, 'hello',[AuthMiddleware::class]);
router::add('GET','/world', HomeController::class, 'world');

router::add('GET','/users/register', UserController::class, 'register',[GuestMiddleware::class]);
router::add('POST','/users/register', UserController::class, 'postRegister',[GuestMiddleware::class]);
router::add('GET','/users/login', UserController::class, 'login',[AuthMiddleware::class]);
router::add('POST','/users/login', UserController::class, 'postLogin',[AuthMiddleware::class]);
router::add('GET','/users/logout', UserController::class, 'logout',[AuthMiddleware::class]);
router::add('GET','/users/profile', UserController::class, 'updateProfile',[AuthMiddleware::class]);
router::add('POST','/users/profile', UserController::class, 'postUpdateProfile',[AuthMiddleware::class]);
router::run();
