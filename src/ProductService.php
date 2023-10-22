<?php
namespace Root\PhpTodo;

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

    public function delete(int $id):void {
        $product = $this->productRepository->findById($id);
        if ($product == null) {
            throw new \Exception("Product is not found");
        }

        $this->productRepository->delete($product);
    }
}