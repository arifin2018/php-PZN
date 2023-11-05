<?php 

namespace Arifin\PHP\test\MVC\Services;

use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\Domain\Session;
use Arifin\PHP\MVC\Repositories\Implement\SessionRepository;
use Arifin\PHP\MVC\Repositories\Implement\UserRepository;
use Arifin\PHP\MVC\Repositories\SessionRepositoryImpl;
use Arifin\PHP\MVC\Repositories\UserRepositoryImpl;
use Arifin\PHP\MVC\Services\SessionService;
use PHPUnit\Framework\TestCase;

class SessionServiceTest extends TestCase{
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;
    private SessionService $sessionService; 
    public function setUp():void{
        $this->sessionRepository = new SessionRepositoryImpl(DatabaseApp::getConnection());
        $this->userRepository = new UserRepositoryImpl(DatabaseApp::getConnection());
        $this->sessionService = new SessionService(new SessionRepositoryImpl(DatabaseApp::getConnection()), new UserRepositoryImpl(DatabaseApp::getConnection()));

        $this->sessionRepository->deleteAll();
    }

    public function testCreate(): void
    {
        $session = $this->sessionService->create(1);
        $this->assertEquals(1, $session->userId);

        $result = $this->sessionRepository->findById($session->id);
        $this->assertEquals(1, $result->userId);
    }

    public function testDestroy(): void
    {
        $session = new Session();
        $session->id = rand(1,3);
        $session->userId = 1;
        $_COOKIE[SessionService::$cookieName] = $session->id;
        $this->sessionRepository->save($session);
        $sessionRepo = $this->sessionRepository->findById($session->id);
        $this->assertEquals(1,$sessionRepo->userId);
        $this->sessionService->destroy();
        $this->assertEquals(1,$sessionRepo->userId);
    }

    public function testCurrent(): void
    {
        $session = new Session();
        $session->id = rand(1,3);
        $session->userId = 1;
        $_COOKIE[SessionService::$cookieName] = $session->id;
        $this->sessionRepository->save($session);
        $currentUser = $this->sessionService->current();
        $this->assertEquals($currentUser->id, $session->userId);
    }
}