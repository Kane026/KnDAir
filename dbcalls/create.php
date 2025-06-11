<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("conn.php");

if (!isset($_POST['entity'])) {
    die('Entiteit niet gespecificeerd.');
}

$entity = $_POST['entity'];

if ($entity === 'flight') {
    // Controleer op vereiste velden
    if (!isset($_POST['Takeoff'], $_POST['Landing'], $_POST['Duration'])) {
        die('Formulier is incompleet ingevuld voor vlucht.');
    }

    $takeoff = trim($_POST['Takeoff']);
    $landing = trim($_POST['Landing']);
    $duration = trim($_POST['Duration']);

    if ($takeoff === '' || $landing === '' || $duration === '') {
        die('Vul alle vluchtvelden in.');
    }

    $sql = "INSERT INTO Flights (Takeoff, Landing, Duration) VALUES (:takeoff, :landing, :duration)";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->bindParam(':takeoff', $takeoff);
        $stmt->bindParam(':landing', $landing);
        $stmt->bindParam(':duration', $duration);

        if ($stmt->execute()) {
            header("Location: ../admin.php?success=flight");
            exit;
        } else {
            echo "Fout bij toevoegen vlucht.";
            print_r($stmt->errorInfo());
        }
    } catch (PDOException $e) {
        echo "PDO Exception: " . $e->getMessage();
    }

} elseif ($entity === 'hotel') {
    if (!isset($_POST['Aankomst'], $_POST['Vertrek'], $_POST['Prijs'], $_POST['AantalPersonen'])) {
        die('Formulier is incompleet ingevuld voor hotel.');
    }

    $aankomst = date('Y-m-d', strtotime($_POST['Aankomst']));
    $vertrek = date('Y-m-d', strtotime($_POST['Vertrek']));
    $prijs = $_POST['Prijs'];
    $personen = $_POST['AantalPersonen'];
    $tickets = isset($_POST['Tickets']) ? 1 : 0;

    $sql = "INSERT INTO Hotels (Aankomst, Vertrek, Prijs, AantalPersonen, Tickets) 
            VALUES (:aankomst, :vertrek, :prijs, :personen, :tickets)";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->bindParam(':aankomst', $aankomst);
        $stmt->bindParam(':vertrek', $vertrek);
        $stmt->bindParam(':prijs', $prijs);
        $stmt->bindParam(':personen', $personen);
        $stmt->bindParam(':tickets', $tickets);

        if ($stmt->execute()) {
            header("Location: ../admin.php?success=hotel");
            exit;
        } else {
            echo "Fout bij toevoegen hotel.";
            print_r($stmt->errorInfo());
        }
    } catch (PDOException $e) {
        echo "PDO Exception: " . $e->getMessage();
    }

} else {
    die('Ongeldige entiteit.');
}
?>
