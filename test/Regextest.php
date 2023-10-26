<?php 

namespace Arifin\PHP\MVC;

use PHPUnit\Framework\TestCase;

class Regextest extends TestCase{
    public function testRegex(): void
    {
        $path = "/product/12345/categories/abcde";

        $pattern = "#^/product/([0-9a-zA-Z]*)/categories/([0-9a-zA-Z]*)$#";

        $result = preg_match($pattern, $path, $variable);

        var_dump($result);
        array_shift($variable);
        var_dump($variable);

        $this->assertEquals(1, $result);

    }
}