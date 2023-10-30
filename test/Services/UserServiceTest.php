<?php 

namespace Arifin\PHP\test\MVC\Services;

use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\Model\UserRegisterRequest;
use Arifin\PHP\MVC\Repositories\UserRepositoryImpl;
use Arifin\PHP\MVC\Services\UserServices;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase{

    private UserServices $userServices;

    public function setUp(): void
    {
        $connection = DatabaseApp::getConnection();
        $userRepository = new UserRepositoryImpl($connection);
        $this->userServices = new UserServices($userRepository);

        $userRepository->deleteAll();
    }

    public function testRegisterSuccess()
    {
        $request = new UserRegisterRequest();
        $request->id = 1;
        $request->name = "arifin";
        $request->password = "password";

        $response = $this->userServices->register($request);

        $this->assertSame($request->id, $response->user->id);
        $this->assertSame($request->name, $response->user->name);
        $this->assertTrue(password_verify($request->password, $response->user->password));
    }

}