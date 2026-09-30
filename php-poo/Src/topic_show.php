<?php

use Entity\Comment;
use Repository\CommentRepository;
use Repository\TopicRepository;


include "include.php";
include "Templates\header.php";



if (isset($_GET["topic"])){
    $commentRepo = \Repository\CommentRepository::getInstance();
    $comments = $commentRepo->findBy($_GET["topic"]);


foreach($comments as $comment){ ?>
    <div class="card" style="width: 18rem;"
  <div class="card-body">
    <h5 class="card-title"><?=  ?> </h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

}
}
