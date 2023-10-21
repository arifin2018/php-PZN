<?php

namespace Root\PhpTodo;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use ProductService;

class ProductTest extends TestCase{
    // ./vendor/bin/phpunit test/ProductTest.php
    private ProductRepository $productRepository;
    private ProductService $productService;
    protected function setUp(): void {
        $this->productRepository = $this->createStub(ProductRepository::class);
        $this->productService = new ProductService($this->productRepository);
    }
}