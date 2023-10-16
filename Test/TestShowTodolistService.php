<?php

require_once(dirname(__FILE__) . "/../Services/TodolistServiceImpl.php");
require_once(dirname(__FILE__) . "/../Services/TodollistService.php");
require_once(dirname(__FILE__) . "/../Repository/TodolistRepositoryImpl.php");
require_once(dirname(__FILE__) . "/../Repository/TodolistRepository.php");
require_once(dirname(__FILE__) . "/../Config/Database.php");

use Config\Database;
use Services\TodolistServiceImpl;

function testShowTodolistService(): void {
    $connection = Database::getConnection();
    $todolistRepository = new TodolistRepositoryImpl($connection);
    $todolistService = new TodolistServiceImpl($todolistRepository);

    $todolistService->showTodolist();
}

testShowTodolistService();