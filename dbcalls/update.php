<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("conn.php");

if (isset($_POST['entity']) && $_POST['entity'] === 'flight') {
    // Vlucht bijwerken
    if (!isset($_POST['id'], $_POST['Takeoff'], $_POST['Landing'], $_POST['Duration'])) {
        die('Vluchtformulier is incompleet ingevuld.');
    }

    $id = $_POST['id'];
    $takeoff = trim($_POST['Takeoff']);
    $landing = trim($_POST['Landing']);
    $duration = trim($_POST['Duration']);

    if ($takeoff === '' || $landing === '' || $duration === '') {
        die('Vul alle vluchtvelden in.');
    }

    $sql = "UPDATE Flights SET Takeoff = :takeoff, Landing = :landing, Duration = :duration WHERE id = :id";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->bindParam(':takeoff', $takeoff);
        $stmt->bindParam(':landing', $landing);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        header("Location: ../admin.php");
        exit;
    } catch (PDOException $e) {
        echo "Fout bij updaten vlucht: " . $e->getMessage();
    }

} elseif (isset($_POST['entity']) && $_POST['entity'] === 'hotel') {
    // Hotel bijwerken
    if (!isset($_POST['id'], $_POST['Aankomst'], $_POST['Vertrek'], $_POST['Prijs'], $_POST['AantalPersonen'])) {
        die('Hotelformulier is incompleet ingevuld.');
    }

    $id = $_POST['id'];
    $aankomst = trim($_POST['Aankomst']);
    $vertrek = trim($_POST['Vertrek']);
    $prijs = trim($_POST['Prijs']);
    $aantal = trim($_POST['AantalPersonen']);
    $tickets = isset($_POST['Tickets']) ? 1 : 0;  // Checkbox

    if ($aankomst === '' || $vertrek === '' || $prijs === '' || $aantal === '') {
        die('Vul alle hotelvelden in.');
    }

    $sql = "UPDATE Hotels SET Aankomst = :aankomst, Vertrek = :vertrek, Prijs = :prijs, AantalPersonen = :aantal, Tickets = :tickets WHERE id = :id";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->bindParam(':aankomst', $aankomst);
        $stmt->bindParam(':vertrek', $vertrek);
        $stmt->bindParam(':prijs', $prijs);
        $stmt->bindParam(':aantal', $aantal);
        $stmt->bindParam(':tickets', $tickets, PDO::PARAM_BOOL);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        header("Location: ../admin.php");
        exit;
    } catch (PDOException $e) {
        echo "Fout bij updaten hotel: " . $e->getMessage();
    }
} else {
    die('Geen geldig formuliertype verzonden.');
}
