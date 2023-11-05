<?php 

namespace Arifin\PHP\MVC\controllers;

use Arifin\PHP\MVC\Config\Database;
use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\Model\UserLoginRequest;
use Arifin\PHP\MVC\Model\UserRegisterRequest;
use Arifin\PHP\MVC\Repositories\SessionRepositoryImpl;
use Arifin\PHP\MVC\Repositories\UserRepositoryImpl;
use Arifin\PHP\MVC\Services\SessionService;
use Arifin\PHP\MVC\Services\UserServices;
use Exception;

class UserController extends Controllers{

    private UserServices $userService;
    private SessionService $sessionService;

    public function __construct()
    {
        $connection = DatabaseApp::getConnection();
        $userRepository = new UserRepositoryImpl($connection);
        $sessionRepository = new SessionRepositoryImpl($connection);

        $this->sessionService = new SessionService($sessionRepository, $userRepository);
        $this->userService = new UserServices($userRepository);
    }

    public function register(): void
    {
        $data = [
            'title'=>'Register',
        ];
        $this->view('user/register',$data);
    }

    public function postRegister(): void
    {
        $request = new UserRegisterRequest();
        $request->id = $_POST['id'];
        $request->name = $_POST['name'];
        $request->password = $_POST['password'];
        $data = [
            'title' => 'register new user',
        ];
        try {
            $this->userService->register($request);
            $this->redirect('/users/login');
        } catch (Exception $e) {
            $data['error'] = $e->getMessage(); 
            $this->view('user/register',$data);
        }
    }

    public function login(): void
    {
        $this->view('user/login',$data);
    }

    public function postLogin(): void {
        $request = new UserLoginRequest();
        $request->id = $_POST['id'];
        $request->password = $_POST['password'];
        try {
            $response = $this->userService->login($request);
            $this->sessionService->create($response->user->id);
            Controllers::redirect('/');
        } catch (Exception $e) {
            $data['error'] = $e->getMessage();
            Controllers::view('user/login', $data);
        }
    }
}
