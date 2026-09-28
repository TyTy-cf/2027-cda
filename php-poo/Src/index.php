<?php

    use Entity\Category;

    include "include.php";

    $category = new Category();
    $category->id = 1;
    $category->name = "Football";

    echo '(' . $category->id . ') ' . $category->name . '<br>';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>2027 CDA PHP POO</title>
    </head>
    <body>

    </body>
</html>
