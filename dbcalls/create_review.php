<?php
include("./conn.php");

$username = $_POST['username'];
$review = $_POST['review'];


$sql = 'INSERT INTO reviews(username, review) VALUES (:username, :review);';
$stmt = $conn->prepare($sql);

$stmt->bindParam(':username', $username);
$stmt->bindParam(':review', $review);

$stmt->execute();


header('Location: ../reviews.php');
exit();
?>