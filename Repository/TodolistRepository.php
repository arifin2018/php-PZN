<?php

namespace Repository;

use Entity\TodoList;

interface TodolistRepository{
    public function save(TodoList $todoList): void;
    public function remove(int $number): bool;
    public function findAll(): array;
}