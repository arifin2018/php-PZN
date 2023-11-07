<?php 

namespace Arifin\PHP\test\MVC\Controllers{
    use Arifin\PHP\MVC\Config\DatabaseApp;
    use Arifin\PHP\MVC\controllers\Controllers;
    use Arifin\PHP\MVC\controllers\UserController;
    use Arifin\PHP\MVC\Domain\Session;
    use Arifin\PHP\MVC\Domain\User;
    use Arifin\PHP\MVC\Model\UserPasswordRequest;
    use Arifin\PHP\MVC\Repositories\Implement\SessionRepository;
    use Arifin\PHP\MVC\Repositories\Implement\UserRepository;
    use Arifin\PHP\MVC\Repositories\SessionRepositoryImpl;
    use Arifin\PHP\MVC\Repositories\UserRepositoryImpl;
    use Arifin\PHP\MVC\Services\SessionService;
    use PHPUnit\Framework\MockObject\MockObject;
    use PHPUnit\Framework\TestCase;
    
    class UserControllerTest extends TestCase
    {
        // ./vendor/bin/phpunit test/Controllers/UserControllerTest.php
        // ./vendor/bin/phpunit test/Controllers/UserControllerTest.php --filter=testLogout
        private UserController $userController;
        private UserRepository $userRepository;
        private SessionRepository $sessionRepository;
        private SessionService $sessionService;
        
        public function setUp(): void
        {
            $this->userController = New UserController();
            $this->userRepository = new UserRepositoryImpl(DatabaseApp::getConnection());
            $this->sessionRepository = new SessionRepositoryImpl(DatabaseApp::getConnection());
            $this->sessionService = new SessionService($this->sessionRepository, $this->userRepository);
            $this->userRepository->deleteAll();
            $this->sessionRepository->deleteAll();
            putenv("mode=test");
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
            $_POST['id'] = 1;
            $_POST['name'] = 'awd';
            $_POST['password'] = 'password';
    
            $this->userController->postRegister();
            $this->expectOutputRegex("[]");
    
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
            $this->expectOutputRegex("[request id name password can't be null]");
    
            // $this->markTestIncomplete("Belom selesai nih unit test nya help dund2");
        }
    
        public function testPostRegisterDuplicate(): void
        {
            $user = new User();
            $user->id = 1;
            $user->name = 'awd';
            $user->password = 'ariifn';
            $this->userRepository->save($user);
    
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
            // $this->markTestIncomplete("Belom selesai nih unit test nya help dund1");
            $user = new User();
            $user->id = 1;
            $user->name = 'awd';
            $user->password = 'ariifn';

            $this->userRepository->save($user);
            
            $_POST['id'] = 1;
            $_POST['password'] = 'ariifn';
            $this->userController->postLogin();
    
            $this->expectOutputRegex("[]");
        }

        public function testLogout(): void
        {
            $user = new User();
            $user->id = rand(1,3);
            $user->name = "arifin";
            $user->password = "password";
            
            $session = new Session();
            $session->id = rand(1,3);
            $session->userId = $user->id;
            
            $this->userRepository->save($user);
            $result = $this->userRepository->findById($user->id);
            $this->sessionRepository->save($session);
            $resultSession = $this->sessionRepository->findById($session->id);
            
            $this->assertEquals($user->id, $result->id);
            $this->assertEquals($session->id, $resultSession->id);
            
            $this->sessionRepository->deleteById($session->id);
            $resultSession = $this->sessionRepository->findById($session->id);
            $this->assertNull($resultSession);
        }

        public function testUpdateProfile(): void
        {
            $user = new User();
            $user->id = 1;
            $user->name = 'arifin ganteng';
            $user->password = 'arifin';
            $this->userRepository->save($user);

            $session = new Session();
            $session->id = 1;
            $session->userId = $user->id;
            $this->sessionRepository->save($session);
            $_COOKIE[SessionService::$cookieName] = $session->id;

            $this->sessionService->current();
            $this->userController->updateProfile();
            $this->expectOutputRegex("[arifin ganteng]");
            $this->expectOutputRegex("[Profile]");
        }
        public function testPostUpdateProfile(): void
        {
            $user = new User();
            $user->id = 1;
            $user->name = 'arifin ganteng';
            $user->password = 'arifin';
            $this->userRepository->save($user);

            $session = new Session();
            $session->id = 1;
            $session->userId = $user->id;
            $this->sessionRepository->save($session);
            $_COOKIE[SessionService::$cookieName] = $session->id;
            $this->sessionService->current();
            $this->userController->postUpdateProfile();
            $this->expectOutputRegex("[]");

        }

        public function testUpdatePassword(): void
        {
            $user = new User();
            $user->id = 3;
            $user->name = 'azriel';
            $user->password = 'password';

            $this->userRepository->save($user);

            $session = new Session();
            $session->id = 3;
            $session->userId = $user->id;
            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$cookieName] = $session->id;

            $this->userController->updatePassword();
            $this->expectOutputRegex("[$user->id]");
        }

        public function testPostUpdatePassword(): void
        {
            $user = new User();
            $user->id = 3;
            $user->name = 'azriel';
            $user->password = 'arifin';
            $this->userRepository->save($user);

            $session = new Session();
            $session->id = 3;
            $session->userId = $user->id;
            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$cookieName] = $session->id;
            $userPasswordRequest = new UserPasswordRequest();
            $userPasswordRequest->id = $user->id;
            $_POST['oldPassword'] = 'arifin';
            $_POST['newPassword'] ='arifin';
            $this->userController->postUpdatePassword();
            $this->expectOutputRegex("[]");

            $result = $this->userRepository->findById($user->id);
            $this->assertTrue(password_verify($_POST['newPassword'], $result->password));
        }
    }
}
