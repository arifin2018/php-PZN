<?php 

namespace Arifin\PHP\MVC\Middlewares;

use Arifin\PHP\MVC\Config\DatabaseApp;
use Arifin\PHP\MVC\controllers\Controllers;
use Arifin\PHP\MVC\Middlewares\interfaces\Middleware;
use Arifin\PHP\MVC\Repositories\SessionRepositoryImpl;
use Arifin\PHP\MVC\Repositories\UserRepositoryImpl;
use Arifin\PHP\MVC\Services\SessionService;

class GuestMiddleware implements Middleware{
    private SessionService $sessionService;
    public function __construct()
    {
        $sessionRepository = new SessionRepositoryImpl(DatabaseApp::getConnection());
        $userRepository = new UserRepositoryImpl(DatabaseApp::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }
    
    public function before(string $next): void
    {
        $currentUser = $this->sessionService->current();
        if ($currentUser == null) {
            $next;
            // Controllers::redirect();
        }else{
            Controllers::redirect('/');
        }
    }
}