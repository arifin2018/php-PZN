<?php

namespace Root\PhpTodo;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase{
    // ./vendor/bin/phpunit test/MathTest.php

    public static function additionProvider()
    {
        return [
            'data set 1' => [[0, 0], 0],
            'data set 2' => [[0, 1], 1],
            'data set 3' => [[1, 0], 1],
            'data set 4' => [[1, 1], 2]
        ];
    }

    /**
     * @dataProvider additionProvider
     * @testdox Adding $a results in $expected
    */
    public function testSum(array $a, int $expected):void {
        $math = new Math();
        $math->sum($a);
        $this->assertSame($expected, $math->getTotal());
    }

    /**
     * @testWith [[0, 0], 0]
     * [[0, 1], 1]
     * [[1, 0], 1]
     * [[1, 1], 2]
    */
    public function testSum2(array $a, int $expected):void {
        $math = new Math();
        $math->sum($a);
        $this->assertSame($expected, $math->getTotal());
    }

    // /**
    //  * @test
    // */
    // public function randomInt():void {
    //     $math = new Math();
    //     $math->randomInt();
    //     $this->assertSame(null,("binggung expect nya apa"), $math->getTotal());
    // }

}