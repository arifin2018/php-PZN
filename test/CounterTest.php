<?php

namespace Root\PhpTodo;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class CounterTest extends TestCase{

    public function testCounter():Counter {
        $counter = new Counter();
        $counter->increment();
        $counter->increment();
        Assert::assertEquals(2, $counter->getCounter());
        $counter->increment();
        return $counter;
    }

    /**
     * @depends testCounter
    */
    public function testCounter2(Counter $counter):void {
        Assert::assertEquals(3, $counter->getCounter());
    }
}