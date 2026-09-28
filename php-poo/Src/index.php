<?php

    include "include.php";

    // parent niveau 0
    $book = new Category();
    $book->setId(1);
    $book->setLabel("Livres");

    // parent niveau 0
    $music = new Category();
    $music->setId(3);
    $music->setLabel("Musique");

    // sous categ niveau 1
    $classic = new Category();
    $classic->setId(4);
    $classic->setLabel("Classique");
    $classic->setParent($music);

    // sous categ niveau 1
    $tourism= new Category();
    $tourism->setId(2);
    $tourism->setLabel("Livres de tourisme et voyage");
    $tourism->setParent($book);

    $characteristic = new Characteristic();
    $characteristic->setId(1);
    $characteristic->setLabel("Couleur précise");
    $characteristic->setValue("blanc");

    $characteristic2 = new Characteristic();
    $characteristic2->setId(2);
    $characteristic2->setLabel("Garantie");
    $characteristic2->setValue("Ce bien bénéficie auprès du vendeur d'une garantie légale de conformité d'une durée de deux ans à compter de sa remise au consommateur");

    $product = new Product();
    $product->setId(1);
    $product->setLabel("Ecouteurs TW JBL - Wave Buds 2 - Blanc");
    $product->setBrand("JBL");
    $product->addCharacteristic($characteristic);
    $product->addCharacteristic($characteristic2);

dump($product->getCharacteristics());

    $brand = new Brands();
    $brand->setId(1);
    $brand->setLabel("Ford");
    $brand->setDescription("Ford, oui");

    $brand2 = new Brands();
    $brand2->setId(2);
    $brand2->setLabel("Opel");
    $brand2->setDescription("Opel, oui");

    $category = new Categories();
    $category->setId(1);
    $category->setLabel("Citadine");
    $category->setDescription("Citadine, oui");

    $model = new Models();
    $model->setId(1);
    $model->setBrand($brand);
    $model->setCategory($category);
    $model->setLabel("Fiesta");
    $model->setDescription("Fiesta, oui");

    $seller = new Sellers();
    $seller->setId(1);
    $seller->setFirstName("Toto");
    $seller->setLastName("Zero");
    $seller->setEmail("totolezero@yahoo.fr");
    $seller->setLocation("Lieu dit du Zero");
    $seller->setPhoneNumber("+33612457893");

    $listing = new Listings();
    $listing->setId(1);
    $listing->setTitle("Citadine Ford Fiesta, oui");
    $listing->setDescription("Citadine Ford Fiesta, oui");
    $listing->setProduceYear("2020");
    $listing->setMileage(123456);
    $listing->setPrice(4567.89);
    $listing->setPublishAt(new DateTime()); // Equivalent SQL : NOW()
    $listing->setModels($model);
    $listing->setSellers($seller);
    $listing->setPrice(4567.89);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>2026 POEI PHP POO</title>
    </head>
    <body>
        <h1><?= $listing->getTitle() ?></h1>
        <p>
            Parue le <?= dateFormat($listing->getPublishAt()) ?>, par <?= $listing->getSellers()->getFullName() ?>
        </p>
    </body>
</html>
