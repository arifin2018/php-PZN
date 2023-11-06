<?php 

namespace Arifin\PHP\test\MVC\Middlewares{

    use Arifin\PHP\MVC\Config\DatabaseApp;
    use Arifin\PHP\MVC\controllers\HomeController;
    use Arifin\PHP\MVC\Middlewares\AuthMiddleware;
    use Arifin\PHP\MVC\Repositories\Implement\SessionRepository;
    use Arifin\PHP\MVC\Repositories\Implement\UserRepository;
    use Arifin\PHP\MVC\Repositories\SessionRepositoryImpl;
    use Arifin\PHP\MVC\Repositories\UserRepositoryImpl;
    use PHPUnit\Framework\TestCase;
    
    class AuthMiddlewareTest extends TestCase
    {
        // ./vendor/bin/phpunit test/Controllers/AuthMiddlewareTest.php
        // ./vendor/bin/phpunit test/Controllers/AuthMiddlewareTest.php --filter=testPostRegisterDuplicate
        private AuthMiddleware $authMiddleware;
        public function setUp(): void
        {
            $this->authMiddleware = new AuthMiddleware;
            putenv("mode=test");
        }

        public function testBefore(): void
        {
            $this->authMiddleware->before("/");
            $this->expectOutputString('');
        }
    }
}
