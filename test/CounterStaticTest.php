<?php

namespace Root\PhpTodo;

use Exception;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class CounterStaticTest extends TestCase{
    // ./vendor/bin/phpunit --filter CounterStaticTest::testSayHelloSuccess test/CounterStaticTest.php
    // ./vendor/bin/phpunit --filter CounterStaticTest::testSayHelloFailed test/CounterStaticTest.php
    // ./vendor/bin/phpunit --filter CounterStaticTest::sayGoodbye test/CounterStaticTest.php
    // ./vendor/bin/phpunit test/CounterStaticTest.php

    private static ?Counter $counter;

    /**
     * sekali dijalankan dan diawal dijalankannya 
     */
    public static function setUpBeforeClass(): void
    {
        self::$counter = new Counter();
    }
    public function testIncrement():void {
        $this->assertEquals(null, self::$counter->getCounter());
        $this->markTestIncomplete("Belom selesai nih unit test nya help dund");
    }

    public function testFirst():void {
        self::$counter->increment();
        self::assertEquals(1, self::$counter->getCounter());
    }

    public function testSecond():void {
        self::$counter->increment();
        self::assertEquals(2, self::$counter->getCounter());
    }

    /**
     * sekali dijalankan dan diakhir dijalankannya 
     */
    public static function tearDownAfterClass(): void
    {
        self::$counter = null;
        echo "Unit Test Selesai". PHP_EOL;
    }
}