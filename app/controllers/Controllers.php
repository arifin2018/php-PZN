<?php 

namespace Arifin\PHP\MVC\controllers;

class Controllers{

    public static function view(string $viewName,?array &$data)
    {

        require(dirname(__FILE__) . "/../views/header.php");
        require(dirname(__FILE__) . "/../views/$viewName.php");
        require(dirname(__FILE__) . "/../views/footer.php");
    }

    public static function redirect(string $url)
    {
        header("Location: $url");
        if (getenv("mode") != 'test') {
            exit();
        }
    }

}