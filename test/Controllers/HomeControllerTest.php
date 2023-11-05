<?php 

namespace Arifin\PHP\test\MVC\Controllers{

    use Arifin\PHP\MVC\Config\DatabaseApp;
    use Arifin\PHP\MVC\controllers\HomeController;
    use Arifin\PHP\MVC\Domain\Session;
    use Arifin\PHP\MVC\Domain\User;
    use Arifin\PHP\MVC\Repositories\Implement\SessionRepository;
    use Arifin\PHP\MVC\Repositories\Implement\UserRepository;
    use Arifin\PHP\MVC\Repositories\SessionRepositoryImpl;
    use Arifin\PHP\MVC\Repositories\UserRepositoryImpl;
    use Arifin\PHP\MVC\Services\SessionService;
    use PHPUnit\Framework\TestCase;
    
    class HomeControllerTest extends TestCase
    {
        // ./vendor/bin/phpunit test/Controllers/HomeControllerTest.php
        // ./vendor/bin/phpunit test/Controllers/HomeControllerTest.php --filter=testPostRegisterDuplicate
        private HomeController $homeController;
        private UserRepository $userRepository;
        private SessionRepository $sessionRepository;

        public function setUp(): void
        {
            $this->homeController = new HomeController();
            $this->userRepository = new UserRepositoryImpl(DatabaseApp::getConnection());
            $this->sessionRepository = new SessionRepositoryImpl(DatabaseApp::getConnection());

            $this->sessionRepository->deleteAll();
            $this->userRepository->deleteAll();
        }

        public function testGuest(): void
        {
            $this->homeController->index();
            $this->expectOutputRegex("[Belajar PHP MVC2]");
        }

        public function testUserLogin(): void
        {
            $user = new User();
            $user->id = 1;
            $user->name = 'arifin';
            $user->password = 'password';
            $this->userRepository->save($user);

            $session = new Session();
            $session->id = 1;
            $session->userId = $user->id;
            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$cookieName] = $session->id;
            $this->homeController->index();
            $this->expectOutputRegex("[Dashboard]");
        }
    }
}
