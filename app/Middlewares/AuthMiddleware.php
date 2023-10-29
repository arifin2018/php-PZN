<?php 

namespace Arifin\PHP\MVC\app\Middlewares;

use Arifin\PHP\MVC\Middlewares\interfaces\Middleware;

class AuthMiddleware implements Middleware{
    public function before(): void
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location:/index.php/world');
            exit();
        }
    }
}