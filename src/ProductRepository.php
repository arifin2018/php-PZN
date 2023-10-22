<?php


namespace Root\PhpTodo;

interface ProductRepository{
    public function findById(?int $id): ?Product;
    public function save($name): Product;
    public function delete($name): void;
    public function findAll():array ;
    
}