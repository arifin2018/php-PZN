<?php

$host="localhost";
$port=54320;
$database="php-pzn";
$username="postgres";
$password="secret";


try {
    $connection = new PDO("pgsql:host=$host;port=$port;dbname=$database",$username,$password);
    
    echo "sukses banget" . PHP_EOL;
} catch (PDOException $e) {
    echo "error: ".$e->getMessage();
}