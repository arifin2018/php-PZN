<?php 

namespace Arifin\PHP\MVC\Config;

use Arifin\PHP\MVC\Config\Database as ConfigDatabase;
use PDO;

class DatabaseApp{

    public static ?PDO $pdo = null;

    public static function getConnection(?string $env = 'test'): PDO {
        if (self::$pdo == null) {
            require_once __DIR__ . '/../../Config/Database.php';
            $config = ConfigDatabase::getDatabaseConfig();
            self::$pdo = new PDO(
                $config['database'][$env]['url'],
                $config['database'][$env]['username'],
                $config['database'][$env]['password'],
            );
        }

        return self::$pdo;
    }

    public static function beginTrasanction()
    {
        self::$pdo->beginTransaction();
    }

    public static function commitTransaction()
    {
        self::$pdo->commit();
    }

    public static function rollbackTransaction()
    {
        self::$pdo->rollBack();
    }
}