<?php 

namespace Arifin\PHP\MVC\Repositories\Implement;

use Arifin\PHP\MVC\Domain\Session;

interface SessionRepository
{
    public function save(Session $session): Session;
    public function findById(int $id): ?Session;
    public function deleteById(int $id): void;
    public function deleteAll(): void;
}