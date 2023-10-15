<?php

function getConnection(){
    $host="localhost";
    $port=54320;
    $database="php-pzn";
    $username="postgres";
    $password="secret";
    
    $link = new PDO("pgsql:host=$host;port=$port;dbname=$database",$username,$password);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $link;
}