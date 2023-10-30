<?php

use Arifin\PHP\MVC\controllers\Controllers;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase{
    public function testRender(): void
    {
        $data = [
            'title'=>'Belajar PHP MVC2'
        ];
        Controllers::view('home/index',$data);
        $this->expectOutputRegex('[Belajar PHP MVC2]');
    }
}