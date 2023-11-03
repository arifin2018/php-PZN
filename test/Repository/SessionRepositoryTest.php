<?php 

namespace Arifin\PHP\test\MVC\Repository;

use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\Domain\Session;
use Arifin\PHP\MVC\Repositories\Implement\SessionsRepository;
use Arifin\PHP\MVC\Repositories\SessionRepositoryImpl;
use PHPUnit\Framework\TestCase;
// ./vendor/bin/phpunit test/Repository/SessionRepositoryTest.php --filter=testSaveSuccess

class SessionRepositoryTest extends TestCase{
    private SessionsRepository $sessionRepository;

    public function setUp(): void
    {
        $this->sessionRepository = new SessionRepositoryImpl(DatabaseApp::getConnection());
    }

    public function testSaveSuccess(): void
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = 1;

        $result = $this->sessionRepository->findById($session->id);

        $this->assertEquals($session->id, $result->id);
    }
    public function testDeleteSuccess(): void
    {
        $this->markTestIncomplete("Belom selesai nih");
    }
    public function testFindByIdSuccess(): void
    {
        $this->markTestIncomplete("Belom selesai nih");
    }
}