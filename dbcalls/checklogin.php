<?php
session_start();


$db_username = "root";      
$db_password = "";      

try {
    $conn = new PDO("mysql:host=localhost;dbname=KnDAir", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Login logica
$stmt = $conn->prepare("SELECT * FROM username WHERE username = :username AND password = :password");
$stmt->bindParam(":username", $_POST['username']);
$stmt->bindParam(":password", $_POST['password']); 
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $_SESSION['username'] = $result['username'];
    header('Location: admin.php');
    exit();
} else {
    echo 'loser';
}
?>
