<?php
session_start();
include(__DIR__ . '/conn.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($username === '' || $email === '' || $password === '') {
    die('Vul alle velden in.');
}

$sql = "SELECT id, password FROM Users WHERE username = :username AND email = :email LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('Gebruiker niet gevonden met deze combinatie.');
}


if ($password === $user['password']) {
    $_SESSION['user_id'] = $user['id'];

    // Admin check
    $adminSql = "SELECT COUNT(*) FROM Admins WHERE user_id = :user_id";
    $adminStmt = $conn->prepare($adminSql);
    $adminStmt->bindParam(':user_id', $user['id']);
    $adminStmt->execute();
    $_SESSION['is_admin'] = $adminStmt->fetchColumn() > 0;

    header('Location: ./admin.php');
    exit;
} else {
    die('Ongeldig wachtwoord.');
}
