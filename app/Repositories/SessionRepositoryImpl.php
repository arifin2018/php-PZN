<?php 

namespace Arifin\PHP\MVC\Repositories;

use Arifin\PHP\MVC\Domain\Session;
use Arifin\PHP\MVC\Repositories\Implement\SessionsRepository;
use PDO;

class SessionRepositoryImpl implements SessionsRepository{
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function save(Session $session): Session{
        $statment = $this->pdo->prepare("insert into sessions(id,user_id) values(?,?)");
        $statment->execute([$session->id, $session->userId]);
        try {
            return new Session;
        }finally {
            $statment->closeCursor();
        }
    }
    public function findById(int $id): Session{
        $statment = $this->pdo->prepare("select id, users_id from sessions where id = ?");
        $statment->execute([$id]);

        try {
            if ($row = $statment->fetch()) {
                $sessions = new Session();
                $sessions->id = $row['id'];
                $sessions->userId = $row['user_id'];
                return $sessions;
            }
        }finally {
            $statment->closeCursor();
        }
        return new Session;
    }
    public function deleteById(int $id): void{
        $statment = $this->pdo->prepare("delete from sessions where id = ?");
        $statment->execute([$id]);
    }
    public function deleteAll(): void{
        $this->pdo->exec("delete from sessions");
    }
}
