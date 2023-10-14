<?php
require_once(dirname(__FILE__) . "/../Helper/Input.php");
require_once(dirname(__FILE__) . "/../BusinessLogic/RemoveTodoList.php");

function viewRemoveTodoList() {
    echo "menghapus TodoList" . PHP_EOL;

    $pilihan = input("Nomor todo (x untuk batal)");

    if (strtolower($pilihan) == 'x') {
        echo "keluar";
    }

    $success = removeTodoList((int)$pilihan);

    if ($success) {
        echo "Berhasil menghapus todo ". $pilihan;
    }else{
        echo "Gagal menghapus todo ". $pilihan;
    }
}