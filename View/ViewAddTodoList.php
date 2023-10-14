<?php
require_once(dirname(__FILE__) . "/../Helper/Input.php");
require_once(dirname(__FILE__) . "/../BusinessLogic/AddTodoList.php");

function viewAddTodoList() {
    echo "Menambah TodoList" . PHP_EOL;

    $todo = input("Todo (x untuk batal)");

    if (strtolower($todo) == 'x') {
        echo "batal menambah todo";
    }else{
        addTodoList($todo);
    }
}