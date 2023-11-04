<?php 

namespace Arifin\PHP\test\MVC\Repository;

use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\Domain\Session;
use Arifin\PHP\MVC\Domain\User;
use Arifin\PHP\MVC\Repositories\Implement\SessionRepository;
use Arifin\PHP\MVC\Repositories\Implement\UserRepository;
use Arifin\PHP\MVC\Repositories\SessionRepositoryImpl;
use Arifin\PHP\MVC\Repositories\UserRepositoryImpl;
use PHPUnit\Framework\TestCase;
// ./vendor/bin/phpunit test/Repository/SessionRepositoryTest.php --filter=testSaveSuccess

class SessionRepositoryTest extends TestCase{
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    public function setUp(): void
    {
        $this->userRepository = new UserRepositoryImpl(DatabaseApp::getConnection());
        $this->sessionRepository = new SessionRepositoryImpl(DatabaseApp::getConnection());
        $this->userRepository->deleteAll();
        $this->sessionRepository->deleteAll();
    }

    public function testSaveSuccess(): void
    {
        $user = new User();
        $user->id = rand(1,3);
        $user->name = "arifin";
        $user->password = "password";
        
        $session = new Session();
        $session->id = rand(1,3);
        $session->userId = $user->id;
        
        $this->userRepository->save($user);
        $this->sessionRepository->save($session);

        $result = $this->sessionRepository->findById($session->id);
        $this->assertEquals($session->id, $result->id);
    }
    public function testDeleteSuccess(): void
    {
        $user = new User();
        $user->id = rand(1,3);
        $user->name = "arifin";
        $user->password = "password";
        
        $session = new Session();
        $session->id = rand(1,3);
        $session->userId = $user->id;
        
        $this->userRepository->save($user);
        $this->sessionRepository->save($session);

        $result = $this->sessionRepository->findById($session->id);
        $this->sessionRepository->deleteById($session->id);
        $resultDelete = $this->sessionRepository->findById($session->id);

        $this->assertEquals($session->id, $result->id);
        $this->assertNull($resultDelete);
    }
}