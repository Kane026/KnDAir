<?php
if (!isset($conn)) {
    include("conn.php");
}
$stmt = $conn->prepare("SELECT * FROM Hotels");
$stmt->execute();
$result_hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);
