<?php

use Repository\TopicRepository;

include "include.php";
    include "Templates/header.php";

?>

<h1 class="my-2">Les derniers topics</h1>

<div class="row">
<?php
$tr = new TopicRepository();

foreach ($tr->findBy([], ['created_at'=>'DESC'], 10) as $topic) {
    include "Templates/topicCard.php";
}
?>
</div>

<?php
    include "Templates/footer.php";
?>


