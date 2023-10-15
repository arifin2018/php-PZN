<?php

require_once('getConnection.php');

$connection = getConnection();

$sql = <<<SQL
    INSERT INTO customers(id,name,email) VALUES(?,?,?)
SQL;

$connection->prepare($sql)->execute([
    2,"azriel","azriel@gmail.com"
]);

$connection = null;