<?php
$host = 'mariadb_server';  // ipv 'localhost'
$db = 'KnDAir';
$user = 'admin';
$pass = 'admin';


$dsn = "mysql:host=$host;dbname=$db;";

try {
    $conn = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die('Verbinding mislukt: ' . $e->getMessage());
}


