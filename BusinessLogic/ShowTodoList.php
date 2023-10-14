<?php

/*
    Menampilkan todo list
    Menampilkan todo list
*/
function showTodoList() {
    global $todolist;

    echo "TodoList" . PHP_EOL;

    foreach ($todolist as $key => $value) {
        echo $key+1 . ". $value" . PHP_EOL;
    }
}