<?php

require_once(dirname(__FILE__) . "/../View/ViewShowTodoList.php");
require_once(dirname(__FILE__) . "/../View/ViewRemoveTodoList.php");

$todolist[] = "belajar PHP Dasar"; 
$todolist[] = "belajar PHP OOP"; 
$todolist[] = "belajar PHP Database"; 
viewRemoveTodoList();
viewShowTodoList();