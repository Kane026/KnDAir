<?php
include("conn.php");  // Zorgt voor verbinding met de juiste database (KnDAir)

$stmt = $conn->prepare("SELECT * FROM Hotels;");
$stmt->execute();
$hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
