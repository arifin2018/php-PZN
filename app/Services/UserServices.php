<?php 

namespace Arifin\PHP\MVC\Services;

use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\Domain\User;
use Arifin\PHP\MVC\Model\UserLoginRequest;
use Arifin\PHP\MVC\Model\UserLoginResponse;
use Arifin\PHP\MVC\Model\UserRegisterRequest;
use Arifin\PHP\MVC\Model\UserRegisterResponse;
use Arifin\PHP\MVC\Repositories\Implement\UserRepository;
use Exception;

class UserServices{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserRegisterRequest $request): UserRegisterResponse
    {
        $this->validationUserRegisterRequest($request);
        try {
            DatabaseApp::beginTrasanction();
            $user = $this->userRepository->findById($request->id);
            if ($user != null) {
                throw new Exception("user already exist", 1);
            }
            $user = new User();
            $user->id = $request->id;
            $user->name = $request->name;
            $user->password = $request->password;

            $this->userRepository->save($user);
            DatabaseApp::commitTransaction();
        } catch (Exception $e) {
            DatabaseApp::rollbackTransaction();
            throw $e;
        }

        $response = new UserRegisterResponse();
        $response->user = $user;
        return $response;
    }
    
    private function validationUserRegisterRequest(UserRegisterRequest $request): void
    {
        if ($request->id == null || $request->name == null | $request->password == null|| trim($request->id)== "" || trim($request->name)== ""|| trim($request->password) == "") {
            throw new Exception("request id name password can't be null");
        }
    }

    private function validationUserLoginRequest(UserLoginRequest $request): void
    {
        if ($request->id == null || $request->password == null|| trim($request->id)== "" || trim($request->password) == "") {
            throw new Exception("request id password can't be null");
        }
    }

    public function login(UserLoginRequest $userLoginRequest): UserLoginResponse
    {
        $this->validationUserLoginRequest($userLoginRequest);
        $user = $this->userRepository->findById($userLoginRequest->id);
        if ($user == null) {
            throw new Exception("id or password is wrong");
        }
        if (password_verify($userLoginRequest->password,$user->password)) {
            $response = new UserLoginResponse();
            $response->user = $user;
            return $response;
        }else{
            throw new Exception("id or password is wrong");
        }
    }

    

}