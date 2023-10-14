<?php

require_once(dirname(__FILE__) . "/../Model/TodoList.php");
require_once(dirname(__FILE__) . "/../BusinessLogic/ShowTodoList.php");

$todolist[] = "belajar PHP Dasar"; 
$todolist[] = "belajar PHP OOP"; 
$todolist[] = "belajar PHP Database"; 

showTodoList();