<?php

require_once(dirname(__FILE__) . "/../Model/TodoList.php");
require_once(dirname(__FILE__) . "/../BusinessLogic/ShowTodoList.php");
require_once(dirname(__FILE__) . "/../BusinessLogic/AddTodoList.php");

$todolist[] = "belajar PHP Dasar"; 
$todolist[] = "belajar PHP OOP"; 
$todolist[] = "belajar PHP Database"; 

addTodoList("belajar ngocok");
showTodoList();