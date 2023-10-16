<?php

use Config\Database;
use Services\TodolistServiceImpl;
use view\TodolistView;

require_once "Entity/TodoList.php";
require_once "Helper/InputHelper.php";
require_once "Repository/TodolistRepository.php";
require_once "Repository/TodolistRepositoryImpl.php";
require_once "Services/TodolistServiceImpl.php";
require_once "Services/TodollistService.php";
require_once "View/TodolistView.php";
require_once "Config/Database.php";


echo "Aplikasi TodoList" . PHP_EOL;
$connection = Database::getConnection();
$todolistReposistory = new TodolistRepositoryImpl($connection);
$todolistServices = new TodolistServiceImpl($todolistReposistory);
$todolistView = new TodolistView($todolistServices);

$todolistView->showTodolist();