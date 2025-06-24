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
    <main>
         <?php

include("./dbcalls/conn.php");
include('./dbcalls/read_hotels.php');

    echo '<div class="reizen-container">';
//Het loopen van de database gegevens
foreach ($result_hotels as $value) {
    echo '<div class="reizen-blok">';

    echo '<h2 class="hotel-naam">' . $value['Naam'] . '</h2>';
    echo '<h3 class="hotel-locatie">' . $value['Locatie'] . '</h3>';
    echo '<p class="hotel-beschrijving">' . $value['Beschrijving'] . '</p>';
    echo '<p class="hotel-aantal-personen">Aantal personen: ' . $value['AantalPersonen'] . '</p>';
    echo '<p class="hotel-prijs">Prijs: €' . $value['Prijs'] . '</p>';
    echo '<button class="beschikbaarheid-knop">Bekijk beschikbaarheid</button>';
    echo '</div>';
}

echo '</div>';
?>
    </main>
    <footer>

    </footer>
</body>

</html>