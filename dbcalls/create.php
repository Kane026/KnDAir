<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("./conn.php");

// Check of POST-variabelen zijn gezet
if (!isset($_POST['Takeoff'], $_POST['Landing'], $_POST['Duration'])) {
    die('Formulier is incompleet ingevuld.');
}

$takeoff = trim($_POST['Takeoff']);
$landing = trim($_POST['Landing']);
$duration = trim($_POST['Duration']);

// Basisvalidatie
if ($takeoff === '' || $landing === '' || $duration === '') {
    die('Vul alle velden in.');
}

// Debugging: laat waarden zien
echo "Takeoff: $takeoff<br>";
echo "Landing: $landing<br>";
echo "Duration: $duration<br>";

// Bereid SQL voor
$sql = "INSERT INTO Flights (Takeoff, Landing, Duration) VALUES (:takeoff, :landing, :duration)";
$stmt = $conn->prepare($sql);

// Bind parameters en check op fouten
try {
    $stmt->bindParam(':takeoff', $takeoff);
    $stmt->bindParam(':landing', $landing);
    $stmt->bindParam(':duration', $duration);

    if ($stmt->execute()) {
        echo "Vlucht succesvol toegevoegd!";
        echo '<br><br><a href="../admin.php"><button>Terug naar Admin</button></a>';
    } else {
        echo "Fout bij toevoegen vlucht.";
        print_r($stmt->errorInfo());
    }
} catch (PDOException $e) {
    echo "PDO Exception: " . $e->getMessage();
}
?>



