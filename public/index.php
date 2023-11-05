<?php

require_once __DIR__ . '/../vendor/autoload.php';
// require_once(dirname(__FILE__) . "/../app/Apps/router.php");

use Arifin\PHP\MVC\apps\router;
use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\controllers\HomeController;
use Arifin\PHP\MVC\controllers\UserController;
use Arifin\PHP\MVC\Middlewares\AuthMiddleware;

DatabaseApp::getConnection('prod');

router::add('GET','/', HomeController::class, 'index');
router::add('GET','/product/([a-z]*)', HomeController::class, 'product');
router::add('GET','/hello', HomeController::class, 'hello',[AuthMiddleware::class]);
router::add('GET','/world', HomeController::class, 'world');

router::add('GET','/users/register', UserController::class, 'register');
router::add('POST','/users/register', UserController::class, 'postRegister');
router::add('GET','/users/login', UserController::class, 'login');
router::add('POST','/users/login', UserController::class, 'postLogin');
router::run();

?>
<!-- 
<html>
    <table>
    <tr>
        <th>Key</th>
        <th>Value</th>
    </tr>
    <?php foreach ($_SERVER as $key => $value) { ?>
    <tr>
        <td><?= $key ?></td>
        <td><?= $value ?></td>
    </tr>
    <?php } ?>
    </table>
</html> -->