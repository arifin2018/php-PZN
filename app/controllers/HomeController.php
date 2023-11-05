<?php 

namespace Arifin\PHP\MVC\controllers;

use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\Repositories\Implement\SessionRepository;
use Arifin\PHP\MVC\Repositories\SessionRepositoryImpl;
use Arifin\PHP\MVC\Repositories\UserRepositoryImpl;
use Arifin\PHP\MVC\Services\SessionService;

class HomeController extends Controllers{

    private SessionService $sessionService;
    public function __construct()
    {
        $connection = DatabaseApp::getConnection();
        $sessionRepositoryImpl = new SessionRepositoryImpl($connection);
        $userRepositoryImpl = new UserRepositoryImpl($connection);
        $this->sessionService = new SessionService($sessionRepositoryImpl, $userRepositoryImpl);
    }

    public function index(): void
    {
        $user = $this->sessionService->current();
        if ($user == null) {
            $data = [
                'title'=>'Belajar PHP MVC2',
                'content'=>'Belajar PHP MVC',
            ];
            $this->view('home/index',$data);
        }else{
            $data = [
                'title'=>'Dashboard',
                'content'=>'Belajar PHP MVC',
                'user'=>[
                    'name'=>$user->name,
                ]
            ];
            $this->view('home/dashboard',$data);
        }


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