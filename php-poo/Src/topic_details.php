<?php

use Entity\Topic;
use Repository\CommentRepository;
use Repository\TopicRepository;

session_start();

include "include.php";
include "Templates/header.php";

$tr = TopicRepository::getInstance();
/** @var Topic $topic */
$topic = $tr->findById($_GET["id"]);

$cr = CommentRepository::getInstance();
$comments = $cr->getMainComments();
?>

<h1 class="my-2"><?= $topic->title ?></h1>

<p><?= $topic->content ?></p>

<?php foreach ($comments as $comment) {

    include "Templates/commentCard.php";
}
?>

<?php

include "Templates/footer.php";

?>
