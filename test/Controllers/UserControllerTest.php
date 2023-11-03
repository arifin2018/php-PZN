<?php 

namespace Arifin\PHP\test\MVC\Controllers{

    use Arifin\PHP\MVC\Config\DatabaseApp;
    use Arifin\PHP\MVC\controllers\Controllers;
    use Arifin\PHP\MVC\controllers\UserController;
    use Arifin\PHP\MVC\Domain\User;
    use Arifin\PHP\MVC\Repositories\UserRepositoryImpl;
    use PHPUnit\Framework\MockObject\MockObject;
    use PHPUnit\Framework\TestCase;
    
    class UserControllerTest extends TestCase
    {
        // ./vendor/bin/phpunit test/Controllers/UserControllerTest.php
        // ./vendor/bin/phpunit test/Controllers/UserControllerTest.php --filter=testPostRegisterDuplicate
        private UserController $userController;
        private UserRepositoryImpl $userRepositoryImpl;
        private MockObject $userBuilder;
        
        public function setUp(): void
        {
            $this->userController = New UserController();
            $this->userRepositoryImpl = new UserRepositoryImpl(DatabaseApp::getConnection());
            $this->userRepositoryImpl->deleteAll();
    
            $this->userBuilder = $this->getMockBuilder(Controllers::class)->onlyMethods(['redirect'])->getMock();
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
            $this->markTestIncomplete("Belom selesai nih unit test nya help dund1");
            $_POST['id'] = 1;
            $_POST['name'] = 'awd';
            $_POST['password'] = 'password';
    
            $this->userController->postRegister();
            $this->expectOutputRegex("[Login]");
    
        }
    
        public function testPostRegisterValidationError(): void
        {
            $_POST['id'] = 1;
            $_POST['name'] = '';
            $_POST['password'] = 'password';
    
            $this->userController->postRegister();
    
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[request name password can't be null]");
    
            // $this->markTestIncomplete("Belom selesai nih unit test nya help dund2");
        }
    
        public function testPostRegisterDuplicate(): void
        {
            $user = new User();
            $user->id = 1;
            $user->name = 'awd';
            $user->password = 'ariifn';
            $this->userRepositoryImpl->save($user);
    
            $_POST['id'] = 1;
            $_POST['name'] = 'awd';
            $_POST['password'] = 'password';
    
            $this->userController->postRegister();
    
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[user already exist]");
            // $this->markTestIncomplete("Belom selesai nih unit test nya help dund3");
        }
    
        /**
         * login
         */
        public function testLogin(): void
        {
            $this->userController->login();
    
            $this->expectOutputRegex("[login]");
        }
    
        /**
         * @runInSeparateProcess
         */
        public function testPostLogin(): void
        {
            $this->markTestIncomplete("Belom selesai nih unit test nya help dund1");
            $_POST['id'] = 1;
            $_POST['password'] = 'arifin';
            $this->userController->postLogin();
    
            header('Location : /');
    
        }
    }
    
}
