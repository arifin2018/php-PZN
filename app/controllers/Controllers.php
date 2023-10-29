<?php 

namespace Arifin\PHP\MVC\controllers;

class Controllers{

    public static function view(string $viewName,array &$data)
    {
        require(dirname(__FILE__) . "/../views/$viewName.php");
    }

}