<?php

require_once('getConnection.php');

$connection = getConnection();

$sql = <<<SQL
    Select * from customers
SQL;

$sqlQuery = $connection->query($sql);
foreach ($sqlQuery as $key => $value) {
    print_r($value);
}

$connection = null;