<?php 

namespace Arifin\PHP\test\MVC\Services;

use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\Domain\User;
use Arifin\PHP\MVC\Model\UserLoginRequest;
use Arifin\PHP\MVC\Model\UserLoginResponse;
use Arifin\PHP\MVC\Model\UserRegisterRequest;
use Arifin\PHP\MVC\Repositories\UserRepositoryImpl;
use Arifin\PHP\MVC\Services\UserServices;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase{

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

}