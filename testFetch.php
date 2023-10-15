<?php

require_once("getConnection.php");

$conection = getConnection();

$sql = <<<SQL
    select * from admin WHERE username = :username and password = :password
SQL;
$username = "admin";
$password = "admin";

$statement = $conection->prepare($sql);
$statement->bindParam("username", $username);
$statement->bindParam("password", $password);
$statement->execute();

print_r($statement->fetch());
print_r($statement->fetch());
print_r($statement->fetch());
// if ($row = $statement->fetch()) {
//     echo "berhasil login " . $row['username'];
// }else{
//     echo "gagal login";
// }
