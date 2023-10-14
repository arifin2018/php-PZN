<?php

use Services\TodolistServiceImpl;

require_once(dirname(__FILE__) . "/../Services/TodolistServiceImpl.php");
require_once(dirname(__FILE__) . "/../Services/TodollistService.php");
require_once(dirname(__FILE__) . "/../Repository/TodolistRepositoryImpl.php");
require_once(dirname(__FILE__) . "/../Repository/TodolistRepository.php");
require_once(dirname(__FILE__) . "/../Entity/TodoList.php");

function testRemoveTodolistService():void {
    $todolistRepository = new TodolistRepositoryImpl();
    $todolistServices = new TodolistServiceImpl($todolistRepository);
    $todolistServices->addTodoList("AYAM");
    $todolistServices->addTodoList("TOKAI");
    $todolistServices->addTodoList("BURUNG");
    $todolistServices->showTodolist();
    $todolistServices->removeTodoList(1);
    $todolistServices->showTodolist();
}
testRemoveTodolistService();