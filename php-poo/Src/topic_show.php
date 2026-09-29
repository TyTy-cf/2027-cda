<?php

use Entity\Comment;
use Entity\Topic;
use Repository\CommentRepository;
use Repository\TopicRepository;

include "include.php";

if (!isset($_GET['topic']) || !is_numeric($_GET['topic'])) {
    header('Location: index.php');
}

$tr = TopicRepository::getInstance();
if (null === $topic = $tr->findById($_GET['topic'])) {
    header('Location: index.php');
}

$cr = CommentRepository::getInstance();
$comments = $cr->findBy(['topic_id' => $topic->id], ['created_at' => 'DESC']);

/** @var Topic $topic */
/** @var array<Comment> $comments */

include "Templates/header.php";

?>

<h1><?= $topic->title ?></h1>

<strong><?= $topic->category->name ?></strong>
<p>
    <?php if ($topic->updatedAt !== null) { ?>
        Modifié le <?= date_format($topic->updatedAt, 'd-m-Y') ?>
    <?php } else { ?>
        Créé le <?= date_format($topic->createdAt, 'd-m-Y') ?>
    <?php } ?>
    par <?= $topic->author->nickname ?>
</p>

<img src="<?= $topic->picture . '?r=' . $topic->id ?>" class="img-fluid" alt="...">

<p class="mt-2 mb-5">
    <?= $topic->content ?>
</p>

<h2>Les commentaires</h2>
<div class="row">
    <?php foreach ($comments as $comment) { ?>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <h3>
                        <?php if ($comment->updatedAt !== null) { ?>
                            Modifié le <?= date_format($comment->updatedAt, 'd-m-Y') ?>
                        <?php } else { ?>
                            Crée le <?= date_format($comment->createdAt, 'd-m-Y') ?>
                        <?php } ?>
                        par <?= $comment->author->nickname ?>
                    </h3>
                    <p class="card-text">
                        <?= $comment->content ?>
                    </p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php
include "Templates/footer.php";
?>

