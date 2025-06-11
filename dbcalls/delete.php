<?php
include("./conn.php");

$id = $_POST['id']; // Let op kleine letter 'id' zoals in het formulier

$stmt = $conn->prepare("DELETE FROM Flights WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();

header('Location: ../admin.php');
exit;  // Zorg altijd dat script stopt na redirect
