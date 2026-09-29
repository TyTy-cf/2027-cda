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
<?php
public function findBy(array $param, array $orderBy = [], ?int $limit = null, ?int $offset = null): array
{
$bindValues = [];
$sql = "SELECT * FROM $this->table";

if (count($param) > 0) {
$conditions = [];
foreach ($param as $key => $value) {
$this->assertValidColumn($key);
$conditions[] = "$key = :value_$key";
$bindValues['value_' . $key] = $value;
}
$sql .= " WHERE " . implode(' AND ', $conditions);
}

if (count($orderBy) > 0) {
$orders = [];
foreach ($orderBy as $column => $direction) {
$this->assertValidColumn($column);
$direction = strtoupper($direction);
if (!in_array($direction, ['ASC', 'DESC'], true)) {
throw new InvalidArgumentException("Direction de tri invalide : $direction");
}
$orders[] = "$column $direction";
}
$sql .= " ORDER BY " . implode(', ', $orders);
}

if ($offset !== null && $limit === null) {
throw new InvalidArgumentException("Un offset nécessite une limite");
}

if ($limit !== null) {
$sql .= " LIMIT :limit";
$bindValues['limit'] = $limit;

if ($offset !== null) {
$sql .= " OFFSET :offset";
$bindValues['offset'] = $offset;
}
}

$sql .= ";";

$stmt = $this->pdo->prepare($sql);
$stmt->execute($bindValues);
$assocArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

$objects = [];
foreach ($assocArray as $row) {
$objects[] = $this->createObjectByAssocArray($row);
}

return $objects;
}


foreach()
?>
<div class="card" style="width: 18rem;">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>

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


