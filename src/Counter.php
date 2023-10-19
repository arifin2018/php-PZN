<?php

namespace Root\PhpTodo;

class Counter{
    private int $counter;

    public function increment():void
    {
        $this->counter++;
    }

    public function getCounter():int {
        return $this->counter;
    }
}