<?php 

namespace Arifin\PHP\test\MVC\Repository;

use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\Domain\User;
use Arifin\PHP\MVC\Repositories\Implement\UserRepository;
use Arifin\PHP\MVC\Repositories\UserRepositoryImpl;
use PHPUnit\Framework\TestCase;

class UserRepositoriesTest extends TestCase{
    // ./vendor/bin/phpunit test/Repository/UserRepositoriesTest.php --filter=testUpdateUser
    private UserRepository $userRepository;

    public function setUp(): void
    {
        $this->userRepository = new UserRepositoryImpl(DatabaseApp::getConnection());
        $this->userRepository->deleteAll();
    }

    public function testSaveSuccess(): void
    {
        $user = new User();
        $user->id = 1;
        $user->name = "arifin";
        $user->password = "password";

        $this->userRepository->save($user);
        $result = $this->userRepository->findById($user->id);

        $this->assertEquals($user->id, $result->id);
        $this->assertEquals($user->name, $result->name);
        $this->assertEquals($user->password, $result->password);
    }

    public function testFindByIdNotFound(): void
    {
        $findUser = $this->userRepository->findById(1);
        $this->assertNull($findUser);
    }

    public function testUpdateUser(): void
    {
        $user = new User();
        $user->id = 1;
        $user->name = 'arifin';
        $user->password = 'password';
        $this->userRepository->save($user);

        $user->name = 'ar';
        $this->userRepository->update($user);
        $findUser = $this->userRepository->findById(1);
        $this->assertEquals($user->name, $findUser->name);
    }

}