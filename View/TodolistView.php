<?php

namespace view;

use InputHelper;
use Services\TodolistService;

class TodolistView{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function showTodolist() : void {
        while (true) {
            $this->todolistService->showTodolist();
    
            echo "Menu" . PHP_EOL;
            echo "1. Tambah Todo" . PHP_EOL;
            echo "2. Hapus Todo" . PHP_EOL;
            echo "x. Keluar" . PHP_EOL;
    
            $pilihan = InputHelper::input("Masukan input");
            if ($pilihan === "1") {
                $this->addTodolist();
            }elseif ($pilihan === "2") {
                $this->removeTodolist();
            }elseif (strtolower($pilihan) === "x") {
                break;
            }else{
                echo "pilihan tidak diketahui\n\n";
            }
        }
    
        echo "\nSampai jumpa\n";
    }
    public function addTodolist() : void {
        echo "Menambah TodoList" . PHP_EOL;

        $todo = InputHelper::input("Todo (x untuk batal)");

        if (strtolower($todo) == 'x') {
            echo "batal menambah todo";
        }else{
            $this->todolistService->addTodolist($todo);
        }
    }
    public function removeTodolist() : void {
        echo "menghapus TodoList" . PHP_EOL;

        $pilihan = InputHelper::input("Nomor todo (x untuk batal)");

        if (strtolower($pilihan) == 'x') {
            echo "keluar";
        }

        $this->todolistService->removeTodoList((int)$pilihan);
    }
}