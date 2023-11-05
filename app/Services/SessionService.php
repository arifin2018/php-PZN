<?php 

namespace Arifin\PHP\MVC\Services;

use Arifin\PHP\MVC\Domain\Session;
use Arifin\PHP\MVC\Domain\User;
use Arifin\PHP\MVC\Repositories\Implement\SessionRepository;
use Arifin\PHP\MVC\Repositories\Implement\UserRepository;

class SessionService{

    public static string $cookieName = 'X-PZN';

    public function __construct(private SessionRepository $sessionRepository,private UserRepository $userRepository) {
        $this->sessionRepository = $sessionRepository;
        $this->userRepository = $userRepository;

    }

    public function create(int $userId): Session
    {
        $session = new Session;
        $session->id = rand(1,4);
        $session->userId = $userId;
        $this->sessionRepository->save($session);
        setcookie(self::$cookieName,$session->id, time()+(60*60*24*30), '/');
        return $session;
    }

    public function destroy(): void
    {
        $sessionId = $_COOKIE[self::$cookieName] ?? 0;
        $this->sessionRepository->deleteById($sessionId);
        setcookie(self::$cookieName,'', 1, '/');
    }

    public function current(): ?User
    {
        $sessionId = $_COOKIE[self::$cookieName] ?? '';
        $session = $this->sessionRepository->findById($sessionId);
        if ($session != null) {
            return $this->userRepository->findById($session->id);
        }else{
            return null;
        }
    }

}