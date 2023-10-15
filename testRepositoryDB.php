<?php

require_once('getConnection.php');
require_once('Repository/CommentRepositoryImpl.php');
require_once('Entity/Commets.php');

use Entity\Comments;
use Repository\CommentRepositoryImpl;

$getConnection = getConnection();
$CommentRepositoryImpl = new CommentRepositoryImpl($getConnection);
// print_r($CommentRepositoryImpl->insert(new Comments(null,"Azriel rafiq",1)));
print_r($CommentRepositoryImpl->findAll());