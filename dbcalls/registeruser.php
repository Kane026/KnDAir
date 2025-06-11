<?php
include('conn.php');

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare('
INSERT INTO Users (username, email, password)
VALUES (:username, :email, :password)
');

$stmt->bindParam("username", $username);
$stmt->bindParam("email", $email);
$stmt->bindParam("password", $password);

$stmt->execute();

header("location: ../index.php?page=home");