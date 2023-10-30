<?php 

namespace Arifin\PHP\MVC\Repositories;

use Arifin\PHP\MVC\Domain\User;
use PDO;

class UserRepository{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(User $user): User
    {
        $statment = $this->connection->prepare("INSERT INTO users(id,name,password) VALUES (?,?,?)");
        $statment->execute([
            $user->id,
            $user->name,
            $user->password
        ]);
        return $user;
    }

    public function findById(int $id): ?User
    {
        $statment = $this->connection->prepare("select id, name, password from users where id = ?");
        $statment->execute([$id]);
        try {
            if ($row = $statment->fetch()) {
                $user = new User;
                $user->id = $row['id'];
                $user->name = $row['name'];
                $user->password = $row['password'];
                return $user;
            }else{
                return null;
            }
        } finally {
            $statment->closeCursor();
        }
    }

    public function deleteAll(): void
    {
        $this->connection->exec('delete from users');
    }
}