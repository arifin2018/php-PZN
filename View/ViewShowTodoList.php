<?php
require_once(dirname(__FILE__) . "/../BusinessLogic/ShowTodoList.php");
require_once(dirname(__FILE__) . "/../Helper/Input.php");
require_once(dirname(__FILE__) . "/ViewAddTodoList.php");

function viewShowTodoList() {
    while (true) {
        showTodoList();

        echo "Menu" . PHP_EOL;
        echo "1. Tambah Todo" . PHP_EOL;
        echo "2. Hapus Todo" . PHP_EOL;
        echo "x. Keluar" . PHP_EOL;

        $pilihan = input("Masukan input");
        if ($pilihan === "1") {
            viewAddTodoList();
        }elseif ($pilihan === "2") {
            viewRemoveTodoList();
        }elseif (strtolower($pilihan) === "x") {
            break;
        }else{
            echo "pilihan tidak diketahui\n\n";
        }
    }

    echo "\nSampai jumpa\n";
}