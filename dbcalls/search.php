<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=header, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>KnDair</title>
</head>

<body>
    <header>
        <?php include('../includes/header.php') ?>
    </header>
    <?php
    include("conn.php");


    $naar = $_GET["naar"];

    $search = $naar;



    $stmt = $conn->prepare("SELECT * FROM Hotels WHERE Locatie = :search ");
    $stmt->bindParam(":search", $search);
    $stmt->execute();
    $hotelResult = $stmt->fetchAll();

    $stmt = $conn->prepare("SELECT * FROM Flights WHERE Landing  = :search ");
    $stmt->bindParam(":search", $search);
    $stmt->execute();
    $flightResult = $stmt->fetchAll();

    echo '<div class="volledige-reis-container">';
        foreach ($hotelResult as $hotel) {
            foreach ($flightResult as $flight) {
            echo '<div class="reis-combinatie-blok">';
            //Het loopen van de database gegevens
            echo '<div class="hotel-blok">';

            echo '<h2 class="hotel-naam">' . $hotel['Naam'] . '</h2>';
            echo '<h3 class="hotel-locatie">' . $hotel['Locatie'] . '</h3>';
            echo '<p class="hotel-beschrijving">' . $hotel['Beschrijving'] . '</p>';
            echo '<p class="hotel-aantal-personen">Aantal personen: ' . $hotel['AantalPersonen'] . '</p>';
            echo '<p class="hotel-prijs">Prijs: €' . $hotel['Prijs'] . '</p>';
            echo '</div>';
        


        echo '<div class="vluchten-container">';

            //Het loopen van de database gegevens
            echo '<div class="vlucht-blok">';
            echo '<h2 class="vlucht-titel">Vlucht naar ' . $flight['Landing'] . '</h2>';
            echo '<p class="vlucht-vertrek">Vertrek: ' . ($flight['Takeoff']) . '</p>';
            echo '<p class="vlucht-duur">Duur: ' . ($flight['Duration']) . ' uur</p>';
            echo '</div>';
        }
        echo '<form method="post" action="boek_reis.php">';
        echo '<input type="hidden" name="hotel_id" value="' . $hotel['id'] . '">';
        echo '<input type="hidden" name="flight_id" value="' . $flight['id'] . '">';
        echo '<button type="submit" class="beschikbaarheid-knop">Boek deze reis</button>';
        echo '</form>';
        echo '</div>';

        echo '</div>';
    }    
        
    echo '</div>';
    ?>