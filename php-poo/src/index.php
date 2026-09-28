<?php

include_once "include.php";

$book = new Category();
$book->id = 1;
$book->name = "Livres";
$book->id = 2;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>2026 POEI PHP POO</title>
</head>

<body>
  <?php
  echo "<pre>";
  dump($book);
  echo "</pre>";
  ?>

</body>

</html>
