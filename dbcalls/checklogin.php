<?php

include('conn.php');
session_start();

$db_username = "root";      
$db_password = "";      

$stmt = $conn->prepare("SELECT * FROM Users WHERE username = :username AND password = :password");
$stmt->bindParam(":username", $_POST['username']);
$stmt->bindParam(":password", $_POST['password']); 
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $_SESSION['username'] = $result['username'];
    header('Location: ../admin.php');
    exit();
} else {
    echo 'loser';
}
?>
