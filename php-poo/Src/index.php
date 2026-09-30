<?php

use Entity\Topic;
use Repository\TopicRepository;

session_start();

include "include.php";
include "Templates/header.php";

$tr = TopicRepository::getInstance();
?>

<h1 class="my-2">Les derniers topics</h1>

<div class="row">
<?php
foreach ($tr->findBy([], ['created_at'=>'DESC'], 12) as $topic) {
    include "Templates/topicCard.php";
}
?>
</div>

<?php

    include "Templates/footer.php";

?>


