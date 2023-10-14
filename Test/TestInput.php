<?php

require_once(dirname(__FILE__) . "/../Model/TodoList.php");
require_once(dirname(__FILE__) . "/../BusinessLogic/ShowTodoList.php");
require_once(dirname(__FILE__) . "/../BusinessLogic/AddTodoList.php");
require_once(dirname(__FILE__) . "/../Helper/Input.php");

// $todolist[] = "belajar PHP Dasar"; 
// $todolist[] = "belajar PHP OOP"; 
// $todolist[] = "belajar PHP Database"; 

$input = input('fullname');
echo $input . PHP_EOL;
$input = input('nickname');
echo $input . PHP_EOL;