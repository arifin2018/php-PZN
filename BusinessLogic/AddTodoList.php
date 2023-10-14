<?php

/*
    Menambah todo list
*/
function addTodoList(string $todo) {
    global $todolist;

    $todolist[count($todolist)] = $todo;
}