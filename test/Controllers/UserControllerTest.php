<?php 

namespace Arifin\PHP\test\MVC\Controllers;

use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\controllers\UserController;
use Arifin\PHP\MVC\Repositories\UserRepositoryImpl;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    private UserController $userController;

    public function setUp(): void
    {
        $this->userController = New UserController();

        $userRepository = new UserRepositoryImpl(DatabaseApp::getConnection());
        $userRepository->deleteAll();
    }

    public function testRegister(): void
    {
        $this->userController->register();
        $this->expectOutputRegex("[Id]");
        $this->expectOutputRegex("[Name]");
        $this->expectOutputRegex("[Password]");
    }
    
    public function testPostRegisterSuccess(): void
    {
        # code...
    }

    public function testPostRegisterValidationError(): void
    {
        # code...
    }

    public function testPostRegisterDuplicate(): void
    {
        # code...
    }
}
