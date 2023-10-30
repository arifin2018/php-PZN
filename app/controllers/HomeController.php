<?php 

namespace Arifin\PHP\MVC\controllers;

class HomeController extends Controllers{
    public function index(): void
    {
        $data = [
            'title'=>'Belajar PHP MVC2',
            'content'=>'Belajar PHP MVC',
        ];
        $this->view('home/index',$data);

    }
    public function hello(): void
    {
        echo "Home Controller.hello";
    }
    public function world(): void
    {
        echo "Home Controller.world";
    }

    public function product(): void
    {
        echo "Home Controller.product";
    }
    public function login(): void
    {
        $request = [
            'username'=>$_POST['username'],
            'password'=>$_POST['password'],
        ];

        $user = [];

        $response=[
            'message'=>'success'
        ];
    }
}