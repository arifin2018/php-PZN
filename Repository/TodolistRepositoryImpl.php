<?php

use Entity\TodoList;
use Repository\TodolistRepository;

require_once(dirname(__FILE__) . "/../Repository/TodolistRepository.php");

class TodolistRepositoryImpl implements TodolistRepository{

    private array $todoList = array();
    private PDO $pdo;

    public function __construct(PDO $connection)
    {
        $this->pdo = $connection;
    }


    public function save(TodoList $todoList): void{
        $connection = $this->pdo;
        $sql = <<<SQL
            INSERT INTO todolist(todo) VALUES(?)
        SQL;

        $connection->prepare($sql)->execute([
            $todoList->getTodo()
        ]);
    }

    public function remove(int $number): bool{
        // $number -= 1;

        // if ($number >= count($this->todoList) ) {
        //     return false;
        // }

        // for ($i=$number; $i < count($this->todoList)-1; $i++) { 
        //     $this->todoList[$i] = $this->todoList[$i+1];
        // }

        // unset($this->todoList[count($this->todoList)-1]);

        $connection = $this->pdo;
        $sql = <<<SQL
            DELETE FROM todolist WHERE id=?
        SQL;

        $data = $connection->prepare($sql);
        $data->execute([
            $number
        ]);

        if ($data->rowCount() > 0) {
            return true;
        }else{
            return false;
        }

    }

    public function findAll(): array{
        return $this->todoList;
    }
}