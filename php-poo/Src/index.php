<?php

use Entity\Topic;
use Repository\CategoryRepository;
use Repository\TopicRepository;

session_start();

include "include.php";
include "Templates/header.php";

$topicRepo = TopicRepository::getInstance();
/** @var array<Topic> $topics */
$topics = $topicRepo->findBy([], ['created_at' => 'DESC'], 12);

?>

<h1>Les derniers topics</h1>

<div class="row">
    <?php foreach ($topics as $topic) { ?>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <img src="<?= $topic->picture . '?r=' . $topic->id ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h2><?= $topic->title ?></h2>
                    <p>
                        <strong><?= $topic->category->name ?></strong>
                        <?php if ($topic->updatedAt !== null) { ?>
                                Modifié le <?= date_format($topic->updatedAt, 'd-m-Y') ?>
                        <?php } else { ?>
                                Crée le <?= date_format($topic->createdAt, 'd-m-Y') ?>
                        <?php } ?>
                        par <?= $topic->author->nickname ?>
                    </p>
                    <a href="topic_show.php?topic=<?php echo($topic->id) ?>">Commentaires</a>
                    <p class="card-text">
                        <?= $topic->content ?>
                    </p>
                </div>
            </div>
        </div>
    <?php } ?>
</div




<?php

    include "Templates/footer.php";

?>


