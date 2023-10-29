<?php 

namespace Arifin\PHP\test\MVC;

use Arifin\PHP\MVC\Apps\Router;
use Arifin\PHP\MVC\Config\DatabaseApp;
use PHPUnit\Framework\TestCase;

class Databasetest extends TestCase{
    public function testDatabase(): void
    {
        // print_r(DatabaseApp::getConnection());
        $connection = DatabaseApp::getConnection();
        self::assertNotNull($connection);
        // $connection = Router::ok();
        // self::assertEquals('ok',$connection);
    }
}