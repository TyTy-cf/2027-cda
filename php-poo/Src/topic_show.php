<?php

use Entity\Topic;
use Repository\CategoryRepository;
use Repository\TopicRepository;
use Repository\CommentRepository;

session_start();

include "include.php";

$SelectedTopic = null;
if (!isset($_GET['topic_id'])) {
    header("Location: index.php");
}
$topicRepo = TopicRepository::getInstance();
if (null === $SelectedTopic = $topicRepo->findById($_GET['topic_id'])) {
    header("Location: index.php");
}
include "Templates/header.php";

$commentRepo = CommentRepository::getInstance();
$comments = $commentRepo->findByTopic($SelectedTopic->id);

?>

    <div class="p-4 p-md-5 d-flex flex-column justify-content-center text-white mb-4 rounded-3 shadow-sm"
          style="min-height: 220px; background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url('<?=$SelectedTopic->picture?>') center/cover no-repeat;">

        <!-- Catégorie -->
        <div class="mb-2">
            <span class="badge bg-primary text-uppercase"><?=$SelectedTopic->category->name?></span>
        </div>

        <!-- Titre du Sujet -->
        <h1 class="fw-bold h2 mb-2"><?=$SelectedTopic->title?></h1>

        <!-- Métadonnées -->
        <p class="mb-0 text-white-50 small">
            Par <strong><?= $SelectedTopic->author->nickname ?></strong> &bull; Le <?= date_format($SelectedTopic->updatedAt,"d/m/Y") ?> &bull;
        </p>
    </div>

    <div class="p-4 bg-secondary-subtle border rounded-3 shadow-sm mb-4">
        <!-- Paragraphe d'introduction avec une police légèrement plus grande -->
        <p class="fs-5 text-secondary mb-3">
            <?= $SelectedTopic->content ?>
        </p>
    </div>
<?php

include "Templates/footer.php";

?>