<?php
use Entity\Topic;
use Repository\UserRepository;
use Repository\CategoryRepository;
use Repository\TopicRepository;
use Repository\CommentRepository;

session_start();

include "include.php";
include "Templates/header.php";

$topicRepo = TopicRepository::getInstance();
$categoryRepo = CategoryRepository::getInstance();
$userRepo = UserRepository::getInstance();
$commentRepo = CommentRepository::getInstance();

$topic = null;
$comments = [];

if (isset($_GET['topic']) && ctype_digit($_GET['topic'])) {
    try {
        $topic = $topicRepo->findById((int) $_GET['topic']);
    } catch (\TypeError) {
        $topic = null;
    }
}

if ($topic instanceof Topic) {
    $comments = $commentRepo->findBy(['topic_id' => $topic->id], ['created_at' => 'DESC']);
}

?>

<?php if (!$topic instanceof Topic) { ?>
    <p>Ce topic n'existe pas.</p>
<?php } else { ?>

    <h1><?= $topic->title ?></h1>

    <h2><?= count($comments) ?> commentaire(s)</h2>

    <?php foreach ($comments as $comment) { ?>
        <div class="card mb-2">
            <div class="card-body">
                <p class="card-text"><?= $comment->content ?></p>
                <p class="card-subtitle text-body-secondary">
                    <?= $comment->author->nickname ?>
                    le <?= date_format($comment->createdAt, 'd-m-Y') ?>
                </p>
            </div>
        </div>
    <?php } ?>

<?php } ?>

<?php

    include "Templates/footer.php";

?>
