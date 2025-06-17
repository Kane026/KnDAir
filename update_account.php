<?php
session_start();
include("dbcalls/conn.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($username === '' || $email === '') {
        header("Location: mijnaccount.php?error=Vul alle verplichte velden in.");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: mijnaccount.php?error=Ongeldig e-mailadres.");
        exit;
    }

    // Update username en email altijd
    $sql = "UPDATE Users SET username = :username, email = :email WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        header("Location: mijnaccount.php?error=Fout bij het bijwerken van gegevens.");
        exit;
    }

    // Wachtwoord wijzigen als velden zijn ingevuld
    if ($current_password !== '' || $new_password !== '' || $confirm_password !== '') {
        if ($new_password !== $confirm_password) {
            header("Location: mijnaccount.php?error=Wachtwoorden komen niet overeen.");
            exit;
        }

        // Haal huidige hash op
        $stmt = $conn->prepare("SELECT password FROM Users WHERE id = :id");
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            header("Location: mijnaccount.php?error=Gebruiker niet gevonden.");
            exit;
        }

        // Controleer huidig wachtwoord
        if (!password_verify($current_password, $user['password'])) {
            header("Location: mijnaccount.php?error=Huidig wachtwoord is onjuist.");
            exit;
        }

        // Hash nieuw wachtwoord en update
        $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE Users SET password = :password WHERE id = :id");
        $stmt->bindParam(':password', $new_password_hash);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            header("Location: mijnaccount.php?error=Fout bij het wijzigen van wachtwoord.");
            exit;
        }
    }

    header("Location: mijnaccount.php?success=1");
    exit;
} else {
    header("Location: mijnaccount.php");
    exit;
}

