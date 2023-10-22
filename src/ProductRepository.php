<?php


namespace Root\PhpTodo;

interface ProductRepository{
    public function findById(?int $id): ?Product;
    public function save(Product $name): Product;
    public function delete(?Product $name): void;
    public function findAll():array ;
    
}