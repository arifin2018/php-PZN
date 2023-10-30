<?php 

namespace Arifin\PHP\MVC\Services;

use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\Domain\User;
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
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);

            $this->userRepository->save($user);
            DatabaseApp::commitTransaction();
        } catch (Exception $e) {
            DatabaseApp::rollbackTransaction();
            throw new $e->getMessage();
        }

        $response = new UserRegisterResponse();
        $response->user = $user;
        return $response;
    }
    
    private function validationUserRegisterRequest(UserRegisterRequest $request): void
    {
        if ($request->id == null || $request->name == null | $request->password == null || trim($request->id) == "" || trim($request->name)== ""|| trim($request->password) == "") {
            throw new Exception("request id name password can't be null");
        }
    }

}