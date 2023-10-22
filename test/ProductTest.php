<?php

namespace Root\PhpTodo;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase{
    // ./vendor/bin/phpunit test/ProductTest.php
    // ./vendor/bin/phpunit --filter ProductTest::testStub test/ProductTest.php
    private ProductRepository $productRepository;
    private ProductService $productService;
    
    protected function setUp(): void {
        $this->productRepository = $this->createStub(ProductRepository::class);
        $this->productService = new ProductService($this->productRepository);
    }

    public function testStub(): void {
        $result = new Product();
        $result->setId(1);  
        $this->productRepository->method('findById')->willReturn($result);
        $data = $this->productRepository->findById(1);          
        $this->assertSame($result,$data);
    }

    public function testStubMap():void   {
        $Product = new Product();
        $Product->setId(1);
        
        $Product2 = new Product();
        $Product2->setId(22);

        $map = [
            [1,  $Product],
            [22,  $Product2]
        ];

        $this->productRepository->method('findById')->willReturnMap($map);
        
        $this->assertSame($Product, $this->productRepository->findById(1));
        $this->assertSame($Product2, $this->productRepository->findById(22));
    }
}
