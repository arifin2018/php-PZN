<?php

require_once __DIR__ . '/../vendor/autoload.php';
// require_once(dirname(__FILE__) . "/../app/Apps/router.php");

use Arifin\PHP\MVC\app\apps\router;
use Arifin\PHP\MVC\app\controllers\HomeController;
use Arifin\PHP\MVC\app\Middlewares\AuthMiddleware;

router::add('GET','/', 'Arifin\PHP\MVC\controllers\HomeController', 'index');
router::add('GET','/product/([a-z]*)', HomeController::class, 'product');
router::add('GET','/hello', HomeController::class, 'hello',[AuthMiddleware::class]);
router::add('GET','/world', HomeController::class, 'world');
router::run();

?>

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
</html>