<?php
include("./conn.php");

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    die("Ongeldig verzoek voor vluchtverwijdering.");
}

$id = intval($_POST['id']);

try {
    $stmt = $conn->prepare("DELETE FROM Flights WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    header("Location: ../admin.php");
    exit;
} catch (PDOException $e) {
    echo "Fout bij verwijderen vlucht: " . $e->getMessage();
}
