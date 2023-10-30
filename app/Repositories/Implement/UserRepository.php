<?php

namespace Arifin\PHP\MVC\Repositories\Implement;

use Arifin\PHP\MVC\Domain\User;

interface UserRepository{
    public function save(User $user): User;
    public function findById(int $id): ?User;
    public function deleteAll(): void;
}