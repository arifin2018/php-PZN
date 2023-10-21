<?php

namespace Root\PhpTodo;

use Exception;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase{
    // ./vendor/bin/phpunit --filter PersonTest::testSayHelloSuccess test/PersonTest.php
    // ./vendor/bin/phpunit --filter PersonTest::testSayHelloFailed test/PersonTest.php
    // ./vendor/bin/phpunit --filter PersonTest::sayGoodbye test/PersonTest.php
    // ./vendor/bin/phpunit test/PersonTest.php

    private Person $person;

    /*
        akan selalu di panggil sebelum unit test di panggil
        contoh :
        kita akan panggil `testSayHelloSuccess` sebelum panggil testSayHelloSuccess dia akan panggil function `setUp` dahulu
    */
    protected function setUp(): void
    {
        $this->person = new Person("Arifin");
    }

    /**
     * @before
     * sama seperti setup yang bikin beda adalah
     */
    public function createPerson(): void
    {
        // $this->person = new Person("Arifin");
    }

    public function tearDown(): void{
        echo "teardown";
    }

    /**
     * @after
     */
    public function tearDownSayHelloSuccess(): void{
        echo "after";
    }

    public function testSayHelloSuccess(): void
    {
        
        Assert::assertEquals("hai Azriel,nama saya Arifin",$this->person->sayHello("Azriel"));
    }

    public function testSayHelloFailed(): void
    {
        $this->expectException(Exception::class);
        $this->person->sayHello(null);
    }

    /**
     * @test
    */
    public function sayGoodbye(): void
    {
        $this->expectOutputString("selamat tinggal Azriel");
        $this->person->sayGoodbye("Azriel");
    }
}