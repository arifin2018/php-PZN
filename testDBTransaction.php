<?php

require_once('getConnection.php');

$connection = getConnection();

$connection->beginTransaction();

$sql = <<<SQL
    insert into comments(comment,customers_id) values(:comment,:cid)
SQL;

$connection->prepare($sql)->execute([
    "comment"=>"lita",
    "cid"=>1
]);
$connection->commit();



$connection = null;