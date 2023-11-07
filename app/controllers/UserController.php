<?php 

namespace Arifin\PHP\MVC\controllers;

use Arifin\PHP\MVC\Config\Database;
use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\Model\UserLoginRequest;
use Arifin\PHP\MVC\Model\UserPasswordRequest;
use Arifin\PHP\MVC\Model\UserProfileUpdateRequest;
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

    public function logout(): void
    {
        $this->sessionService->destroy();
        $this->redirect('/');
    }

    public function updateProfile(): void
    {
        $user = $this->sessionService->current();
        $data =[
            "title"=>"update user profile",
            'id'=>$user->id,
            'name'=>$user->name
        ];
        Controllers::view('user/profile',$data);
    }

    public function postUpdateProfile(): void
    {
        $user = $this->sessionService->current();
        $request = new UserProfileUpdateRequest();
        $request->id = $user->id;
        $request->name = $_POST['name'];
        $request->password = $user->password;

        try {
            $this->userService->updateProfile($request);
            $this->redirect('/');
        } catch (\Throwable $e) {
            $data = [
                "title"=>"update user profile",
                'id'=>$user->id,
                'name'=>$user->name,
                'error'=> $e->getMessage()
            ];
            Controllers::view('user/profile',$data);
        }

    }

    public function updatePassword(): void
    {
        $user = $this->sessionService->current();
        $data =[
            "title"=>"update user password",
            'id'=>$user->id,
        ];
        Controllers::view('user/password',$data);
    }

    public function postUpdatePassword(): void
    {
        $user = $this->sessionService->current();
        $request = new UserPasswordRequest();
        $request->id = $user->id;
        $request->newPassword = $_POST['oldPassword']; 
        $request->oldPassword = $_POST['newPassword'];
        try {
            $this->userService->updatePassword($request);
            Controllers::redirect('/');
        } catch (Exception $e) {
            $data = [
                "title"=>"update user password",
                "error"=>$e->getMessage(),
                'id'=>$user->id,
            ];
            Controllers::view('user/password',$data);
        }
    }
}
