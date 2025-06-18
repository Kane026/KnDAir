<?php
include("./dbcalls/conn.php");

    $stmt = $conn->prepare("SELECT * FROM reviews;");
    $stmt->execute();
    $result = $stmt->fetchAll(); ?>