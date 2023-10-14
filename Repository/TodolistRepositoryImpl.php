<?php

use Entity\TodoList;
use Repository\TodolistRepository;

require_once(dirname(__FILE__) . "/../Repository/TodolistRepository.php");

class TodolistRepositoryImpl implements TodolistRepository{

    private array $todoList = array();

    public function save(TodoList $todoList): void{
        $this->todoList[count($this->todoList)] = $todoList->getTodo();
    }

    public function remove(int $number): bool{
        $number -= 1;

        if ($number >= count($this->todoList) ) {
            return false;
        }

        for ($i=$number; $i < count($this->todoList)-1; $i++) { 
            $this->todoList[$i] = $this->todoList[$i+1];
        }

        unset($this->todoList[count($this->todoList)-1]);

        return true;
    }

    public function findAll(): array{
        return $this->todoList;
    }
}