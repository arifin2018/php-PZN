<?php

require_once __DIR__ . '/../vendor/autoload.php';
// require_once(dirname(__FILE__) . "/../app/Apps/router.php");

use Arifin\PHP\MVC\apps\router;

router::add('GET','/', 'HomeController', 'index');
router::add('GET','/login', 'UserController', 'login');
router::add('GET','/register', 'RegisterController', 'register');

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