<?php
$host = 'mariadb_server';  // je database host
$db = 'KnDAir';
$user = 'admin';
$pass = 'admin';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // Foutmeldingen als exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   // Fetch als associatieve arrays
    PDO::ATTR_EMULATE_PREPARES => false,                 // Native prepares
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Verbinding mislukt: ' . $e->getMessage());
}
