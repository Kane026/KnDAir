<?php
include("conn.php");  // Zorgt voor verbinding met de juiste database (KnDAir)

$stmt = $conn->prepare("SELECT * FROM Flights;");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
