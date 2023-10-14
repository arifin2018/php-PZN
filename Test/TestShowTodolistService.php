<?php

require_once(dirname(__FILE__) . "/../Services/TodolistServiceImpl.php");
require_once(dirname(__FILE__) . "/../Services/TodollistService.php");
require_once(dirname(__FILE__) . "/../Repository/TodolistRepositoryImpl.php");
require_once(dirname(__FILE__) . "/../Repository/TodolistRepository.php");

use Services\TodolistServiceImpl;

function testShowTodolistService(): void {
    $todolistRepository = new TodolistRepositoryImpl();
    $todolistService = new TodolistServiceImpl($todolistRepository);

    $todolistService->showTodolist();
}

testShowTodolistService();