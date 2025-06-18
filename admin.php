<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit;
}

include('./dbcalls/conn.php');
include('./dbcalls/read_flights.php');  
include('./dbcalls/read_hotels.php');   
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./assets/css/style.css" />
</head>
<body>
    <?php include('./includes/header.php'); ?>

    <main>
        <h1>Admin Panel</h1>
        <?php if (!empty($result_flights)): ?>
            <?php foreach ($result_flights as $flight): ?>
                <form action="./dbcalls/update.php" method="post">
                    <input type="hidden" name="entity" value="flight" />
                    <input type="hidden" name="id" value="<?= htmlspecialchars($flight['id']) ?>" />
                    <input type="text" name="Takeoff" value="<?= htmlspecialchars($flight['Takeoff']) ?>" />
                    <input type="text" name="Landing" value="<?= htmlspecialchars($flight['Landing']) ?>" />
                    <input type="text" name="Duration" value="<?= htmlspecialchars($flight['Duration']) ?>" />
                    <button type="submit">Update vlucht</button>
                </form>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Geen vluchten gevonden.</p>
        <?php endif; ?>

       
        <?php if (!empty($result_hotels)): ?>
            <?php foreach ($result_hotels as $hotel): ?>
                <form action="./dbcalls/update.php" method="post">
                    <input type="hidden" name="entity" value="hotel" />
                    <input type="hidden" name="id" value="<?= htmlspecialchars($hotel['id']) ?>" />
                    <input type="date" name="Aankomst" value="<?= htmlspecialchars($hotel['Aankomst']) ?>" />
                    <input type="date" name="Vertrek" value="<?= htmlspecialchars($hotel['Vertrek']) ?>" />
                    <input type="number" name="Prijs" step="0.01" value="<?= htmlspecialchars($hotel['Prijs']) ?>" />
                    <input type="number" name="AantalPersonen" value="<?= htmlspecialchars($hotel['AantalPersonen']) ?>" />
                    <label>
                        <input type="checkbox" name="Tickets" <?= !empty($hotel['Tickets']) ? 'checked' : '' ?> />
                        Tickets inbegrepen
                    </label>
                    <button type="submit">Update hotel</button>
                </form>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Geen hotels gevonden.</p>
        <?php endif; ?>
    </main>

    <?php include('./includes/footer.php'); ?>
</body>
</html>
