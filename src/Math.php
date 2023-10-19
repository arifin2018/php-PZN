<?php

namespace Root\PhpTodo;

class Math{
    private int $total = 0;

    public function sum(array $values):void
    {
        foreach ($values as $key => $value) {
            $this->total += $value;
        }
    }

    public function getTotal():int {
        return $this->total;
    }
}