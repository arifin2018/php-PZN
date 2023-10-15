<?php

namespace Config;

use PDO;

class Database{
    public static function getConnection(): PDO {
        $host = "database";
        $port = "5432";
        $database = "php-pzn";
        $username = "postgres";
        $password = "secret";

        $link = new PDO("pgsql:host=$host;port=$port;dbname=$database",$username,$password);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $link;
    }
}