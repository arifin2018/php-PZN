<?php 

namespace Arifin\PHP\MVC\controllers;

use Arifin\PHP\MVC\Config\Database;
use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\Model\UserRegisterRequest;
use Arifin\PHP\MVC\Repositories\UserRepositoryImpl;
use Arifin\PHP\MVC\Services\UserServices;
use Exception;

class UserController extends Controllers{

    private UserServices $userService;

    public function __construct()
    {
        $connection = DatabaseApp::getConnection();
        $userRepository = new UserRepositoryImpl($connection);
        $this->userService = new UserServices($userRepository);
    }

    public function register(): void
    {
        $data = [
            'title'=>'Register',
            'error'=>'Register',
        ];
        $this->view('/user/register',[
            $data
        ]);
    }

    public function postRegister(): void
    {
        $request = new UserRegisterRequest();
        $request->name = $_POST['name'];
        $request->password = $_POST['password'];

        try {
            $this->userService->register($request);
        } catch (Exception $e) {
            $this->view('Users/register',[
                'title' => 'register new user',
                'error' => $e->getMessage()
            ]);
        }
    }
}
