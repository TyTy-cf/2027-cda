<?php

use Repository\TopicRepository;
use Repository\CommentRepository;

include "../include.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header('Location: ../index.php');
}

$topicRepository = new TopicRepository();
$topic = $topicRepository->findById($_GET['id']);

if (!$topic) {
  header('Location: ../index.php');
}

$commentRepository = new CommentRepository();
$comments = $commentRepository->findBy(['topic_id' => $_GET['id']], ['created_at' => 'ASC']);
include "header.php";
?>

<main class="container p-3">
  <div class="card">
    <div class="card-header justify-content-between d-flex">
      <h1><?= $topic->title ?></h1>
      <h2><?= $topic->category->name ?></h2>
    </div>
    <div class="card-body">
      <p><?= $topic->content ?></p>
      <p>Par : <?= $topic->author->nickname ?></p>
      <p>Le <?= $topic->createdAt->format('d/m/Y') ?></p>
      <p><?= $topic->updatedAt ? "Mis à jour le : " . $topic->updatedAt->format('d/m/Y') : "" ?></p>
      <?php foreach ($comments as $comment) : ?>
        <div class="card my-3">
          <div class="card-header">
            <h5 class="card-title"><?= $comment->author->nickname ?></h5>
          </div>
          <div class="card-text p-3 d-flex flex-column gap-2">
            <p><?= $comment->content ?></p>
            <p>Le <?= $comment->createdAt->format('d/m/Y') ?></p>
            <?php if ($comment->parent) : ?>
              <p>En réponse à : <?= $comment->parent->author->nickname ?></p>
            <?php endif; ?>
          </div>
        </div>

      <?php endforeach; ?>
    </div>
  </div>
</main>
