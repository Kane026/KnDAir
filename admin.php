<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
    exit;
}

include('./dbcalls/conn.php');
include('./dbcalls/read_flights.php');
include('./dbcalls/read_hotels.php');
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <?php include('./includes/header.php'); ?>
    <main>
        <h1>Admin Panel</h1>

        <section class="admin-form-wrapper">
            <h2>Vlucht Toevoegen</h2>
            <form class="admin-form" action="./dbcalls/create.php" method="post">
                <input type="hidden" name="entity" value="flight">
                <label>Vertrek luchthaven:</label>
                <input type="text" name="Takeoff" required>
                <label>Aankomst luchthaven:</label>
                <input type="text" name="Landing" required>
                <label>Vluchtduur:</label>
                <input type="text" name="Duration" required>
                <input type="submit" value="Vlucht toevoegen">
            </form>

            <h2>Hotel Toevoegen</h2>
            <form class="admin-form" action="./dbcalls/create.php" method="post">
                <input type="hidden" name="entity" value="hotel">
                <label>Aankomst datum:</label>
                <input type="date" name="Aankomst" required>
                <label>Vertrek datum:</label>
                <input type="date" name="Vertrek" required>
                <label>Prijs:</label>
                <input type="number" name="Prijs" step="0.01" required>
                <label>Aantal personen:</label>
                <input type="number" name="AantalPersonen" required>
                <label>
                    <input type="checkbox" name="Tickets"> Inclusief tickets
                </label>
                <input type="submit" value="Hotel toevoegen">
            </form>
        </section>

        <section class="admin-data-wrapper">
            <h2>Vluchten Bewerken</h2>
            <?php foreach ($result_flights as $flight): ?>
                <form class="admin-form" action="./dbcalls/update.php" method="post">
                    <input type="hidden" name="entity" value="flight">
                    <input type="hidden" name="id" value="<?= $flight['id']; ?>">
                    <input type="text" name="Takeoff" value="<?= $flight['Takeoff']; ?>">
                    <input type="text" name="Landing" value="<?= $flight['Landing']; ?>">
                    <input type="text" name="Duration" value="<?= $flight['Duration']; ?>">
                    <button type="submit">Update</button>
                </form>
                <form class="admin-form delete-form" action="./dbcalls/delete.php" method="post">
                    <input type="hidden" name="entity" value="flight">
                    <input type="hidden" name="id" value="<?= $flight['id']; ?>">
                    <input type="submit" value="Verwijder">
                </form>
            <?php endforeach; ?>

            <h2>Hotels Bewerken</h2>
            <?php foreach ($result_hotels as $hotel): ?>
                <form class="admin-form" action="./dbcalls/update.php" method="post">
                    <input type="hidden" name="entity" value="hotel">
                    <input type="hidden" name="id" value="<?= $hotel['id']; ?>">
                    <input type="date" name="Aankomst" value="<?= $hotel['Aankomst']; ?>">
                    <input type="date" name="Vertrek" value="<?= $hotel['Vertrek']; ?>">
                    <input type="number" name="Prijs" step="0.01" value="<?= $hotel['Prijs']; ?>">
                    <input type="number" name="AantalPersonen" value="<?= $hotel['AantalPersonen']; ?>">
                    <label>
                        <input type="checkbox" name="Tickets" <?= $hotel['Tickets'] ? 'checked' : ''; ?>>
                        Tickets inbegrepen
                    </label>
                    <button type="submit">Update</button>
                </form>
                <form class="admin-form delete-form" action="./dbcalls/delete.php" method="post">
                    <input type="hidden" name="entity" value="hotel">
                    <input type="hidden" name="id" value="<?= $hotel['id']; ?>">
                    <input type="submit" value="Verwijder">
                </form>
            <?php endforeach; ?>
        </section>

        <div style="text-align: center; margin-top: 20px;">
            <a class="fill-button" href="index.php">Terug naar Home</a>
        </div>
    </main>
    <?php include('./includes/footer.php'); ?>
</body>
</html>
