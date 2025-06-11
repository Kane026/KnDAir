<?php
if (!isset($conn)) {
    include("conn.php");
}
$stmt = $conn->prepare("SELECT * FROM Flights");
$stmt->execute();
$result_flights = $stmt->fetchAll(PDO::FETCH_ASSOC);
