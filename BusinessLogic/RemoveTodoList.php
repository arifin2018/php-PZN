<?php

/*
    Menghapus todo list
*/
function removeTodoList(int $number):bool {
    global $todolist;
    $number -= 1;

    if ($number >= count($todolist) ) {
        return false;
    }

    for ($i=$number; $i < count($todolist)-1; $i++) { 
        $todolist[$i] = $todolist[$i+1];
    }

    unset($todolist[count($todolist)-1]);

    return true;
}