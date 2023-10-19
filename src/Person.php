<?php

namespace Root\PhpTodo;

use Exception;

class Person{
    public function __construct(private string $name)
    {
        
    }

    public function sayHello(?String $name):string {
        if ($name === null) {
            throw new Exception("gagal");
        }else{
            return "hai $name,nama saya $this->name";
        }
    }
}

print_r((new Person("arifin"))->sayHello(null));