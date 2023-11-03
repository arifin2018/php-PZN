<?php 

namespace Arifin\PHP\MVC\Repositories\Implement;

use Arifin\PHP\MVC\Domain\Session;

interface SessionsRepository
{
    public function save(Session $session): Session;
    public function findById(int $id): Session;
    public function deleteById(int $id): void;
    public function deleteAll(): void;
}