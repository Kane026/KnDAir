<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=header, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>KnDair</title>
</head>

<body>
    <header>
        <?php include('./includes/header.php') ?>
    </header>
    <?php
    include("conn.php");

    $searchResult = $_GET["searchresult"];

    $test = '%' . $searchResult . '%';

    $stmt = $conn->prepare("SELECT * FROM Flights WHERE Productnaam LIKE :product;");
    $stmt->bindParam(":product", $test);
    $stmt->execute();

    $result = $stmt->fetchAll();


    foreach ($result as $key => $value) {

        echo '<div class="menu-item-box">';
        echo '<br>' . '<img src="' . $value['img'] . '">';
        echo '<br> ' . $value['ProductNaam'];
        echo '<br> ' . $value['Prijs'];
        echo '<br> <span class="beschrijving">' . $value['Beschrijving'] . '</span>';


        echo '</div>';
    }
    ?>