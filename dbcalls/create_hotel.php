<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("./conn.php");

if (!isset($_POST['Aankomst'], $_POST['Vertrek'], $_POST['Prijs'], $_POST['AantalPersonen'])) {
    die('Formulier is incompleet ingevuld.');
}

$aankomst = trim($_POST['Aankomst']);
$vertrek = trim($_POST['Vertrek']);
$prijs = floatval($_POST['Prijs']);
$aantalPersonen = intval($_POST['AantalPersonen']);
$tickets = isset($_POST['Tickets']) ? 1 : 0;

if ($aankomst === '' || $vertrek === '' || $prijs <= 0 || $aantalPersonen <= 0) {
    die('Vul alle velden correct in.');
}

echo "Aankomst: $aankomst<br>";
echo "Vertrek: $vertrek<br>";
echo "Prijs: $prijs<br>";
echo "Aantal Personen: $aantalPersonen<br>";
echo "Tickets: " . ($tickets ? 'Ja' : 'Nee') . "<br>";

$sql = "INSERT INTO Hotels (Aankomst, Vertrek, Prijs, AantalPersonen, Tickets) 
        VALUES (:aankomst, :vertrek, :prijs, :aantalPersonen, :tickets)";
$stmt = $conn->prepare($sql);

try {
    $stmt->bindParam(':aankomst', $aankomst);
    $stmt->bindParam(':vertrek', $vertrek);
    $stmt->bindParam(':prijs', $prijs);
    $stmt->bindParam(':aantalPersonen', $aantalPersonen);
    $stmt->bindParam(':tickets', $tickets);

    if ($stmt->execute()) {
        echo "Hotel succesvol toegevoegd!";
        echo '<br><br><a href="../admin.php"><button>Terug naar Admin</button></a>';
    } else {
        echo "Fout bij toevoegen hotel.";
        print_r($stmt->errorInfo());
    }
} catch (PDOException $e) {
    echo "PDO Exception: " . $e->getMessage();
}
?>
