<?php

namespace Root\PhpTodo;

use Exception;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase{
    // ./vendor/bin/phpunit --filter PersonTest::testSayHelloSuccess test/PersonTest.php
    // ./vendor/bin/phpunit --filter PersonTest::testSayHelloFailed test/PersonTest.php

    public function testSayHelloSuccess(): void
    {
        $person = new Person("Arifin");
        Assert::assertEquals("hai Azriel,nama saya Arifin",$person->sayHello("Azriel"));
    }

    public function testSayHelloFailed(): void
    {
        $this->expectException(Exception::class);
        $person = new Person("Arifin");
        $person->sayHello(null);
    }
}