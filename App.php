<?php

$host="database";
$port=5432;
$database="php-pzn";
$username="postgres";
$password="secret";

$connection = new PDO("pgsql:host=$host;port=$port;dbname=$database",$username,$password);

echo "sukses banget" . PHP_EOL;