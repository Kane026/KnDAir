<?php
$servername = "mariadb";
$username = "admin";
$password = "admin";

try {
  $conn = new PDO("mysql:host=$servername;dbname=KnDAir;port=3306;", $username, $password);

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>