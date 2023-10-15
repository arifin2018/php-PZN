<?php

namespace Repository;
require_once('Repository/CommentRepository.php');

use Entity\Comments;
use PDO;

class CommentRepositoryImpl implements CommentRepository{
    private $PDO;

    public function __construct($connection)
    {
        $this->PDO = $connection;
    }

    public function insert(Comments $comments):Comments{
        $connection = $this->PDO;

        $connection->beginTransaction();

        $sql = <<<SQL
            insert into comments(comment,customers_id) values(:comment,:cid)
        SQL;

        $connection->prepare($sql)->execute([
            "comment"=>$comments->getComment(),
            "cid"=>$comments->getCustomerId()
        ]);
        $connection->commit();

        $comments->setId($connection->lastInsertId());
        $connection = null;
        return $comments;
    }

    public function find(int $id):?Comments{
        $connection = $this->PDO;

        $sql = <<<SQL
            select * from comments WHERE id = :id
        SQL;

        $statement = $connection->prepare($sql);
        $statement->bindParam("id", $id);
        $statement->execute();

        if ($row = $statement->fetch()) {
            return new Comments(
                $row['id'],
                $row['comment'],
                $row['cid'],
            );
        }else{
            return null;
        }
    }
    
    public function findAll():array{
        $connection = $this->PDO;

        $sql = <<<SQL
            select * from comments
        SQL;

        $statement = $connection->prepare($sql);
        $statement->execute();

        $data = [];

        if ($row = $statement->fetchAll()) {
            foreach ($row as $key => $value) {
                $data[] = new Comments(
                    $value['id'],
                    $value['comment'],
                    $value['customers_id'],
                );
            }
        }

        return $data;
    }
}