<?php

namespace Root\PhpTodo;

class Counter{
    private int $counter = 0;
    private static int $number = 0;

    public function increment():void
    {
        $this->counter= $this->counter+1;
    }

    public function getCounter():int {
        return $this->counter;
    }

    public function increaseNumber():bool{
        self::$number++;
        return true;
    }
    public function getNumber():int{
        return self::$number;
    }
}