<?php 
session_start();
include('conn.php');

$user_id = $_SESSION['user_id'];
$hotel_id = $_POST['hotel_id'];
$flight_id = $_POST['flight_id'];

$sql = "INSERT INTO Bookings (user_id, hotel_id, flight_id) VALUES (:user_id, :hotel_id, :flight_id)";
$stmt = $conn->prepare($sql);

$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':hotel_id', $hotel_id);
$stmt->bindParam(':flight_id', $flight_id);
$stmt->execute();

header('Location: ../mijnaccount.php');

