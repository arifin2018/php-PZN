<?php

namespace Root\PhpTodo;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class CounterTest extends TestCase{
    // ./vendor/bin/phpunit --filter CounterTest::testCounter test/CounterTest.php
    // ./vendor/bin/phpunit test/CounterTest.php
    public function testCounter():Counter {
        $this->markTestSkipped("");
        $counter = new Counter();
        $counter->increment();
        $counter->increment();
        Assert::assertEquals(2, $counter->getCounter());
        $counter->increment();
        return $counter;
    }

    /**
     * @depends testCounter
     * bergantung pada testCounter yang dimana dia akan melanjutkan dari testCounter lalu ke testCounter2
    */
    public function testCounter2(Counter $counter):void {
        Assert::assertEquals(3, $counter->getCounter());
    }

    public function testCounter3():void {
        $counter = new Counter();
        Assert::assertEquals(0, $counter->getCounter());
    }

    /**
     * @requires PHP >= 8.0
     */
    public function testOnlyPHP8():void {
        $this->assertTrue(true);
    }
}