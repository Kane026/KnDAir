<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conn.php");

if (isset($_POST['Naam']) && isset($_POST['Beschrijving']) && isset($_POST['Locatie']) && isset($_POST['Aankomst']) && isset($_POST['Vertrek']) && isset($_POST['Prijs']) && isset($_POST['AantalPersonen'])) 
    
    $naam = $_POST['Naam'];
    $beschrijving = $_POST['Beschrijving'];
    $locatie = $_POST['Locatie'];
    $aankomst = $_POST['Aankomst'];
    $vertrek = $_POST['Vertrek'];
    $prijs = $_POST['Prijs'];
    $aantal = $_POST['AantalPersonen'];
    
    if ($aankomst != "" && $vertrek != "" && $prijs > 0 && $aantal > 0) {
        if (isset($_POST['Tickets'])) {
            $tickets = 1;
        } else {
            $tickets = 0;
        }

        echo "Naam: " . $naam . "<br>";
        echo "Beschrijving: " . $beschrijving . "<br>";
        echo "Locatie " . $locatie . "<br>";
        echo "Aankomst: " . $aankomst . "<br>";
        echo "Vertrek: " . $vertrek . "<br>";
        echo "Prijs: " . $prijs . "<br>";
        echo "Aantal Personen: " . $aantal . "<br>";
        echo "Tickets: " . $tickets . "<br>";

        $sql = "INSERT INTO Hotels (Naam, Beschrijving, Locatie, Aankomst, Vertrek, Prijs, AantalPersonen, Tickets) VALUES ('$naam', '$beschrijving', '$locatie', '$aankomst', '$vertrek', '$prijs', '$aantal', '$tickets')";
        
        if ($conn->query($sql)) {
            echo "Toegevoegd!";
            echo '<br><a href="../admin.php"><button>Terug</button></a>';
    } else {
        echo "Vul alle velden in.";
    }
} else {
    echo "Niet alles is ingevuld.";
}
?>
