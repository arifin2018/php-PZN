<?php
namespace Services;

require_once(dirname(__FILE__) . "/../Services/TodollistService.php");

use Entity\TodoList;
use Repository\TodolistRepository;

class TodolistServiceImpl implements TodolistService{
    private TodolistRepository $todolistRepository;

    public function __construct(TodolistRepository $todolistRepository)
    {
        $this->todolistRepository = $todolistRepository;
    }
    
    public function showTodolist(): void
    {
        echo "TodoList" . PHP_EOL;

        $todolist = $this->todolistRepository->findAll();
        foreach ($todolist as $key => $value) {
            $valueTodo = $value->getTodo();
            $valueId = $value->getId();
            echo $valueId . ". $valueTodo" . PHP_EOL;
        }
    }

    public function addTodoList(String $todo):void{
        $todolist = new TodoList($todo);
        $this->todolistRepository->save($todolist);
        echo "Sukses menambah todo" . PHP_EOL;
    }

    public function removeTodoList(int $number):void{
        if ($this->todolistRepository->remove($number)) {
            echo "Berhasil menghapus todolist" . PHP_EOL;
        }else{
            echo "Gagal menghapus todolist" . PHP_EOL;
        }
    }
}