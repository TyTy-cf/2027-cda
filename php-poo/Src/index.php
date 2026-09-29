<?php

use Repository\TopicRepository;

include "include.php";
include "Templates/header.php";

$topicRepository = new TopicRepository();
$topics = $topicRepository->findBy([], ['created_at' => 'DESC'], 10);

?>

<h1>Les derniers topics</h1>

<main class="container d-flex flex-wrap gap-3">
  <?php foreach ($topics as $topic) : ?>
    <div class="card" style="width: 18rem;">
      <img class="card-img-top" src="<?= $topic->picture . "?r=" . $topic->id ?>" alt="Card image cap">
      <div class="card-body d-flex flex-column justify-content-between">
        <h5 class="card-title"><?= $topic->title ?></h5>
        <p class="card-text"><?= substr($topic->content, 0, 50) ?>...</p>
        <p class="card-text">Le <?= $topic->createdAt->format('d/m/Y') ?></p>
        <p class="card-text">Par : <?= $topic->author->nickname ?></p>
        <p class="card-text">Catégorie : <?= $topic->category->name ?></p>
        <p class="card-text"> <?= $topic->updatedAt ? "Mis à jour le : " . $topic->updatedAt->format('d/m/Y') : "" ?></p>
        <a href="./Templates/topic_show.php?id=<?= $topic->id ?>" class="btn btn-primary">Voir le topic</a>
      </div>
    </div>
  <?php endforeach; ?>
</main>

<?php
include "Templates/footer.php";
?>
