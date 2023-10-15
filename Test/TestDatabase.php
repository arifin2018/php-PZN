<?php

use Config\Database;

require_once(dirname(__FILE__) . "/../Config/Database.php");

$db = Database::getConnection();
print_r($db);