<?php 

namespace Arifin\PHP\MVC\Services;

use Arifin\PHP\MVC\Config\Database;
use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\Domain\User;
use Arifin\PHP\MVC\Model\UserLoginRequest;
use Arifin\PHP\MVC\Model\UserLoginResponse;
use Arifin\PHP\MVC\Model\UserPasswordRequest;
use Arifin\PHP\MVC\Model\UserPasswordResponse;
use Arifin\PHP\MVC\Model\UserProfileUpdateRequest;
use Arifin\PHP\MVC\Model\UserProfileUpdateResponse;
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

    public function updateProfile(UserProfileUpdateRequest $userProfileUpdateRequest): UserProfileUpdateResponse
    {
        $this->validationUserProfileUpdateRequest($userProfileUpdateRequest);
        try {
            DatabaseApp::beginTrasanction();
            $user = $this->userRepository->findById($userProfileUpdateRequest->id);
            if ($user == null) {
                throw new Exception("User is not found");
            }

            $user->name = $userProfileUpdateRequest->name;
            $this->userRepository->update($user);
            DatabaseApp::commitTransaction();

            $response = new UserProfileUpdateResponse();
            $response->user = $user;
            return $response;
        } catch (Exception $e) {
            DatabaseApp::rollbackTransaction();
            throw $e;
        }
    }

    public function validationUserProfileUpdateRequest(UserProfileUpdateRequest $request): void
    {
        if ($request->id == null || $request->name == null || $request->password == null|| trim($request->id)== ""|| trim($request->name)== "" || trim($request->password) == "") {
            throw new Exception("request id name password can't be null");
        }
    }

    public function updatePassword(UserPasswordRequest $userPasswordRequest): UserPasswordResponse
    {
        $this->validationUpdatePassword($userPasswordRequest);
        try {
            DatabaseApp::beginTrasanction();
            $user = $this->userRepository->findById($userPasswordRequest->id);
            if ($user == null) {
                throw new Exception("user not found");
            }
            
            if (!password_verify($user->password, $userPasswordRequest->oldPassword)) {
                throw new Exception("a password wrong");
            }

            $user->password = $userPasswordRequest->newPassword;
            $this->userRepository->update($user);
            DatabaseApp::commitTransaction();

            $response = new UserPasswordResponse();
            $response->user = $user;
            return $response;
        } catch (Exception $e) {
            DatabaseApp::rollbackTransaction();
            throw new Exception($e->getMessage(), 1);
        }
    }

    public function validationUpdatePassword(UserPasswordRequest $userPasswordRequest): void
    {
        if ($userPasswordRequest->id == null || $userPasswordRequest->newPassword == null || $userPasswordRequest->oldPassword == null) {
            throw new Exception("request id newPassword oldPassword can't be null");
        }
    }
}