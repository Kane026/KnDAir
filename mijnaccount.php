<?php
session_start();
include("dbcalls/conn.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT username, email FROM Users WHERE id = :id LIMIT 1";
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
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mijn Account - KnDair</title>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <header>
        <?php include('./includes/header.php'); ?>
    </header>

    <main class="account-container">
        <h1>Mijn Account</h1>

        <?php if (isset($_GET['success'])): ?>
            <p class="success-message">Je gegevens zijn succesvol bijgewerkt!</p>
        <?php elseif (isset($_GET['error'])): ?>
            <p class="error-message"><?= htmlspecialchars($_GET['error']) ?></p>
        <?php endif; ?>

        <form method="post" action="update_account.php" class="account-form">
            <label for="username">Gebruikersnaam:</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

            <label for="email">E-mailadres:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <hr>

            <h2>Wachtwoord wijzigen</h2>
            <label for="current_password">Huidig wachtwoord:</label>
            <input type="password" id="current_password" name="current_password" placeholder="Laat leeg als je wachtwoord niet wil wijzigen">

            <label for="new_password">Nieuw wachtwoord:</label>
            <input type="password" id="new_password" name="new_password" placeholder="Laat leeg als je wachtwoord niet wil wijzigen">

            <label for="confirm_password">Bevestig nieuw wachtwoord:</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Laat leeg als je wachtwoord niet wil wijzigen">

            <button type="submit" class="btn-submit">Gegevens opslaan</button>
        </form>

        <form method="post" action="logout.php" style="margin-top: 20px;">
            <button type="submit" class="btn-logout">Uitloggen</button>
        </form>
        <?php
        $sql = "SELECT * FROM Bookings WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $bookings = $stmt->fetchAll();
        foreach ($bookings as $booking) {
            $sqlHotel = "SELECT * FROM Hotels WHERE id = :hotel_id";
            $stmtHotel = $conn->prepare($sqlHotel);
            $stmtHotel->bindParam(':hotel_id', $booking['hotel_id']);
            $stmtHotel->execute();
            $hotel = $stmtHotel->fetch();

            $sqlFlight = "SELECT * FROM Flights WHERE id = :flight_id";
            $stmtFlight = $conn->prepare($sqlFlight);
            $stmtFlight->bindParam(':flight_id', $booking['flight_id']);
            $stmtFlight->execute();
            $flight = $stmtFlight->fetch();


            echo '<div class="reis-combinatie-blok">';
            //Het loopen van de database gegevens
            echo '<div class="hotel-blok">';

            echo '<h2 class="hotel-naam">' . $hotel['Naam'] . '</h2>';
            echo '<h3 class="hotel-locatie">' . $hotel['Locatie'] . '</h3>';
            echo '<p class="hotel-beschrijving">' . $hotel['Beschrijving'] . '</p>';
            echo '<p class="hotel-aantal-personen">Aantal personen: ' . $hotel['AantalPersonen'] . '</p>';
            echo '<p class="hotel-prijs">Prijs: €' . $hotel['Prijs'] . '</p>';
            echo '</div>';



            echo '<div class="vluchten-container">';

            //Het loopen van de database gegevens
            echo '<div class="vlucht-blok">';
            echo '<h2 class="vlucht-titel">Vlucht naar ' . $flight['Landing'] . '</h2>';
            echo '<p class="vlucht-vertrek">Vertrek: ' . ($flight['Takeoff']) . '</p>';
            echo '<p class="vlucht-duur">Duur: ' . ($flight['Duration']) . ' uur</p>';
            echo '</div>';

            echo '<form method="post" action="dbcalls/delete_reis.php">';
            echo '<input type="hidden" name="ID" value="' . $booking['id'] . '">';
            echo '<button>Verwijder booking</button>';
            echo '</div>';
        }
        echo '</div>';
        ?>
    </main>
</body>

</html>