<?php 

namespace Arifin\PHP\MVC\controllers;

class HomeController{
    public function index(): void
    {
        echo "Home Controller.index";
    }
    public function hello(): void
    {
        echo "Home Controller.hello";
    }
    public function world(): void
    {
        echo "Home Controller.world";
    }
}