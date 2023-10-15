<?php
namespace Repository;

use Entity\Comments;

interface CommentRepository{
    public function insert(Comments $comments):Comments;
    public function find(int $id):?Comments;
    public function findAll():array;
}