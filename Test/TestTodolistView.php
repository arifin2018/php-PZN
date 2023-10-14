<?php

use Services\TodolistServiceImpl;
use view\TodolistView;

require_once(dirname(__FILE__) . "/../Services/TodolistServiceImpl.php");
require_once(dirname(__FILE__) . "/../Services/TodollistService.php");
require_once(dirname(__FILE__) . "/../Repository/TodolistRepositoryImpl.php");
require_once(dirname(__FILE__) . "/../Repository/TodolistRepository.php");
require_once(dirname(__FILE__) . "/../Entity/TodoList.php");
require_once(dirname(__FILE__) . "/../View/TodolistView.php");
require_once(dirname(__FILE__) . "/../Helper/InputHelper.php");

function TestShowTodolistView():void {
    $todolistRepository = new TodolistRepositoryImpl();
    $todolistService = new TodolistServiceImpl($todolistRepository);
    $todolistview = new TodolistView($todolistService);

    $todolistService->addTodoList("BURUNG");
    $todolistService->addTodoList("AYAM");
    $todolistService->addTodoList("CEKER");

    $todolistview->showTodolist();
}
// TestShowTodolistView();

function TestAddTodolistView():void {
    $todolistRepository = new TodolistRepositoryImpl();
    $todolistService = new TodolistServiceImpl($todolistRepository);
    $todolistview = new TodolistView($todolistService);

    $todolistService->addTodoList("BURUNG");
    $todolistService->addTodoList("AYAM");
    $todolistService->addTodoList("CEKER");

    $todolistview->showTodolist();
}
TestAddTodolistView();