<?php
session_start();
include(__DIR__ . '/dbcalls/conn.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT username, email FROM Users WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Gebruiker niet gevonden.");
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <title>Mijn Account</title>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
    <?php include(__DIR__ . '/includes/header.php'); ?>

    <main style="color: white; padding: 2rem; max-width: 600px; margin: auto;">
        <h1>Mijn Account</h1>
        <div style="background: white; color: black; padding: 2rem; border-radius: 10px;">
            <p><strong>Gebruikersnaam:</strong> <?= htmlspecialchars($user['username']) ?></p>
            <p><strong>E-mailadres:</strong> <?= htmlspecialchars($user['email']) ?></p>
        </div>
    </main>

    <?php include(__DIR__ . '/includes/footer.php'); ?>
</body>
</html>
