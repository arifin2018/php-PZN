<?php

namespace Root\PhpTodo;

use Exception;
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
        $Product2->setId(null);

        $map = [
            [1,  $Product],
            [null,  $Product2]
        ];

        $this->productRepository->method('findById')->willReturnMap($map);
        
        $this->assertSame($Product, $this->productRepository->findById(1));
        $this->assertSame($Product2, $this->productRepository->findById(null));
    }
    
    public function testStubCallback(): void {
        $this->productRepository->method('findById')->willReturnCallback(function (int $id){
            $product = new Product();
            $product->setId($id);
            return $product;
        });

        $this->assertEquals(1,$this->productRepository->findById(1)->getId());
    }

    public function testRegisterSuccess():void {
        $this->productRepository->method("findById")->willReturn(null);
        $this->productRepository->method("save")->willReturnArgument(0);

        $product = new Product();
        $product->setId(1);
        $product->setName("arifin");

        $result = $this->productService->register($product);

        $this->assertEquals($product->getId(), $result->getId());
    }

    public function testRegisterFailed() :void {
        // $this->expectException(Exception::class);

        $productInDB = new Product();
        $productInDB->setId(1);

        $this->productRepository->method("findById")->willReturn($productInDB);

        $product = new Product();
        $product->setId(1);

        $this->productService->register($product);
    }
}
