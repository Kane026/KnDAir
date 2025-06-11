<?php
session_start();
if (isset($_SESSION['username'])):
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Admin Panel</title>
</head>
<body>
    <?php include('./includes/header.php'); ?>
    <main>
        <h1>Admin</h1>

        <section class="create">
            <h2>Voeg vlucht toe</h2>
            <form action="./dbcalls/create.php" method="post">
                <label for="takeoff">Vertrek luchthaven:</label>
                <input type="text" name="Takeoff" id="takeoff">

                <label for="landing">Aankomst luchthaven:</label>
                <input type="text" name="Landing" id="landing">

                <label for="duration">Duur:</label>
                <input type="text" name="Duration" id="duration">

                <input type="submit" value="Toevoegen">
            </form>

            <h2>Voeg hotel toe</h2>
            <form action="./dbcalls/create_hotel.php" method="post">
                <label for="aankomst">Aankomst (YYYY-MM-DD):</label>
                <input type="date" name="Aankomst" id="aankomst">

                <label for="vertrek">Vertrek (YYYY-MM-DD):</label>
                <input type="date" name="Vertrek" id="vertrek">

                <label for="prijs">Prijs:</label>
                <input type="number" name="Prijs" step="0.01" id="prijs">

                <label for="aantal">Aantal personen:</label>
                <input type="number" name="AantalPersonen" id="aantal">

                <label>
                    <input type="checkbox" name="Tickets" value="1"> Tickets inbegrepen
                </label>

                <input type="submit" value="Toevoegen">
            </form>
        </section>

        <h2>Vluchten beheren</h2>
        <section class="admin">
            <?php
            include("./dbcalls/conn.php");
            include('./dbcalls/read.php');
            foreach ($result as $value):
            ?>
                <form action="./dbcalls/update.php" method="post">
                    <input type="hidden" name="id" value="<?= $value['id']; ?>">
                    <input type="text" name="Takeoff" value="<?= $value['Takeoff']; ?>">
                    <input type="text" name="Landing" value="<?= $value['Landing']; ?>">
                    <input type="text" name="Duration" value="<?= $value['Duration']; ?>">
                    <button type="submit">Update</button>
                </form>
                <form action="./dbcalls/delete.php" method="post">
                    <input type="hidden" name="id" value="<?= $value['id']; ?>">
                    <input type="submit" value="Delete">
                </form>
            <?php endforeach; ?>
        </section>

        <h2>Hotels beheren</h2>
        <section class="admin">
            <?php
            include('./dbcalls/read_hotels.php');
            foreach ($hotels as $hotel):
            ?>
                <form action="./dbcalls/update_hotel.php" method="post">
                    <input type="hidden" name="id" value="<?= $hotel['id']; ?>">
                    <input type="date" name="Aankomst" value="<?= $hotel['Aankomst']; ?>">
                    <input type="date" name="Vertrek" value="<?= $hotel['Vertrek']; ?>">
                    <input type="number" name="Prijs" step="0.01" value="<?= $hotel['Prijs']; ?>">
                    <input type="number" name="AantalPersonen" value="<?= $hotel['AantalPersonen']; ?>">
                    <label>
                        <input type="checkbox" name="Tickets" <?= $hotel['Tickets'] ? 'checked' : '' ?>> Tickets
                    </label>
                    <button type="submit">Update</button>
                </form>
                <form action="./dbcalls/delete_hotel.php" method="post">
                    <input type="hidden" name="id" value="<?= $hotel['id']; ?>">
                    <input type="submit" value="Delete">
                </form>
            <?php endforeach; ?>
        </section>

        <a class="active" href="index.php">Terug naar Home</a>
    </main>
    <?php include('./includes/footer.php'); ?>
</body>
</html>

<?php else:
    header("Location: ../index.php");
endif; ?>
