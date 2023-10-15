<?php

require_once('getConnection.php');

$connection = getConnection();

$username = $connection->quote("admins");
$password = $connection->quote("admin");

$sql = <<<SQL
    select * from admin WHERE username = $username and PASSWORD = $password
SQL;

$sqlQuery = $connection->query($sql);
$success = false;
foreach ($sqlQuery as $key => $value) {
    $success = true;
    $username = $value['username'];
}

if ($success) {
    echo "sukses login";
}else{
    echo "gagal login";
}

$connection = null;