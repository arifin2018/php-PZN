<?php

use Root\PhpTodo\Product;
use Root\PhpTodo\ProductRepository;

use function PHPUnit\Framework\throwException;

class ProductService{

    public function __construct(private ProductRepository $productRepository){}

    public function register(Product $product):Product {
        if ($this->productRepository->findById($product->getId()) !== null) {
            throw new \Exception("product all ready exist");
        }
        return $this->productRepository->save($product);
    }
}