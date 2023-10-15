<?php

use Config\Database;
use Services\TodolistServiceImpl;

require_once(dirname(__FILE__) . "/../Services/TodolistServiceImpl.php");
require_once(dirname(__FILE__) . "/../Services/TodollistService.php");
require_once(dirname(__FILE__) . "/../Repository/TodolistRepositoryImpl.php");
require_once(dirname(__FILE__) . "/../Repository/TodolistRepository.php");
require_once(dirname(__FILE__) . "/../Entity/TodoList.php");
require_once(dirname(__FILE__) . "/../Config/Database.php");

function testAddTodolistService():void {
    $connection = Database::getConnection();
    $todolistRepository = new TodolistRepositoryImpl($connection);
    $todolistServices = new TodolistServiceImpl($todolistRepository);
    $todolistServices->addTodoList("AYAM");
    $todolistServices->addTodoList("TOKAI");
    $todolistServices->addTodoList("BURUNG");
}
testAddTodolistService();