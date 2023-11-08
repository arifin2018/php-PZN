<?php 

namespace Arifin\PHP\test\MVC\Services;

use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\Domain\User;
use Arifin\PHP\MVC\Model\UserLoginRequest;
use Arifin\PHP\MVC\Model\UserLoginResponse;
use Arifin\PHP\MVC\Model\UserPasswordRequest;
use Arifin\PHP\MVC\Model\UserProfileUpdateRequest;
use Arifin\PHP\MVC\Model\UserRegisterRequest;
use Arifin\PHP\MVC\Repositories\UserRepositoryImpl;
use Arifin\PHP\MVC\Services\UserServices;
use Exception;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase{
    // ./vendor/bin/phpunit test/Services/UserServiceTest.php
    // ./vendor/bin/phpunit test/Services/UserServiceTest.php --filter=

    private UserServices $userServices;
    private UserRepositoryImpl $userRepositoryImpl;

    public function setUp(): void
    {
        $connection = DatabaseApp::getConnection();
        $this->userRepositoryImpl = new UserRepositoryImpl($connection);
        $this->userServices = new UserServices($this->userRepositoryImpl);

        $this->userRepositoryImpl->deleteAll();
    }

    public function testRegisterSuccess()
    {
        $request = new UserRegisterRequest();
        $request->id=1;
        $request->name = "arifin";
        $request->password = "password";

        $response = $this->userServices->register($request);
        $this->assertSame($request->name, $response->user->name);
        $this->assertTrue(password_verify($request->password, $response->user->password));
    }

    public function testLogin(): void
    {
        $user = new User();
        $user->id = 1;
        $user->name = 'arifin';
        $user->password = 'password';
        $this->userRepositoryImpl->save($user);

        $request = new UserLoginRequest();
        $request->id = 1;
        $request->password = 'password';

        $response = $this->userServices->login($request);
        $this->assertEquals($user->id, $response->user->id);
        $this->assertTrue(password_verify($user->password, $response->user->password));
    }

    public function testUpdateValidationSuccess(): void
    {
        $user = new User();
        $user->id = 1;
        $user->name = "tuyul";
        $user->password = "arifin";
        $this->userRepositoryImpl->save($user);
        
        $request = new UserProfileUpdateRequest();
        $request->id = 1;
        $request->name="arifin";
        $request->password = "arifin";
        $this->userServices->updateProfile($request);
    

        $result = $this->userRepositoryImpl->findById($user->id);
        $this->assertEquals($request->name, $result->name);
    }

    public function testUpdateValidationError(): void
    {
        $this->expectException(Exception::class);
        $request = new UserProfileUpdateRequest();
        $request->id = 1;
        $request->name="";
        $request->password = "";
        $this->userServices->updateProfile($request);
    }

    public function testUpdatePassword(): void
    {
        $user = new User();
        $user->id = 1;
        $user->name = 'arifins';
        $user->password = 'password';
        $this->userRepositoryImpl->save($user);

        $request = new UserPasswordRequest();
        $request->id = 1;
        $request->newPassword = 'arifin';
        $request->oldPassword = 'password';

        $result = $this->userServices->updatePassword($request);
        $this->assertEquals($result->user->id, $request->id);
    }
}