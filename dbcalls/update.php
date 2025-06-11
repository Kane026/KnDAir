<?php

include("conn.php");

$productnaam = $_POST['productnaam'];
$prijs = $_POST['Prijs'];

$sql = 'UPDATE menuitems SET Productnaam = :productnaam, prijs = :prijs;';
$stmt = $conn->prepare($sql);
$stmt->bindParam(":productnaam", $productnaam );
$stmt->bindParam(":prijs", $prijs );
$stmt->execute();


header("location: ../admin.php");