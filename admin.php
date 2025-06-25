<?php
// Verbinden met de database via PDO
try {
    $conn = new PDO("mysql:host=mariadb;dbname=KnDAir;charset=utf8", "root", "root");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Databaseconnectie mislukt: " . $e->getMessage());
}

// Haalt de vluchten op
$stmt = $conn->query("SELECT * FROM Flights");
$vluchten = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];

// Haalt de hotels op
$stmt = $conn->query("SELECT * FROM Hotels");
$hotels = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['entity']) && isset($_POST['actie'])) {
    $entity = $_POST['entity'];
    $actie = $_POST['actie'];

    if ($actie == 'toevoegen') {
        if ($entity == 'flight') {
            $takeoff = $_POST['Takeoff'];
            $landing = $_POST['Landing'];
            $duration = $_POST['Duration'];
            $dateAankomst = $_POST['Date-aankomst'];
            $dateVertrek = $_POST['Date-vertrek'];

            $stmt = $conn->prepare("INSERT INTO Flights (Takeoff, Landing, Duration, `Date-aankomst`, `Date-vertrek`) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$takeoff, $landing, $duration, $dateAankomst, $dateVertrek]);
        } elseif ($entity == 'hotel') {
            $aankomst = $_POST['Aankomst'];
            $vertrek = $_POST['Vertrek'];
            $prijs = $_POST['Prijs'];
            $aantalPersonen = $_POST['AantalPersonen'];
            $tickets = isset($_POST['Tickets']) ? 1 : 0;

            $stmt = $conn->prepare("INSERT INTO Hotels (Aankomst, Vertrek, Prijs, AantalPersonen, Tickets) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$aankomst, $vertrek, $prijs, $aantalPersonen, $tickets]);
        }
    } elseif ($actie == 'update') {
        if ($entity == 'flight') {
            $id = $_POST['id'];
            $takeoff = $_POST['Takeoff'];
            $landing = $_POST['Landing'];
            $duration = $_POST['Duration'];
            $dateAankomst = $_POST['Date-aankomst'];
            $dateVertrek = $_POST['Date-vertrek'];

            $stmt = $conn->prepare("UPDATE Flights SET Takeoff = ?, Landing = ?, Duration = ?, `Date-aankomst` = ?, `Date-vertrek` = ? WHERE id = ?");
            $stmt->execute([$takeoff, $landing, $duration, $dateAankomst, $dateVertrek, $id]);
        } elseif ($entity == 'hotel') {
            $id = $_POST['id'];
            $aankomst = $_POST['Aankomst'];
            $vertrek = $_POST['Vertrek'];
            $prijs = $_POST['Prijs'];
            $aantalPersonen = $_POST['AantalPersonen'];
            $tickets = isset($_POST['Tickets']) ? 1 : 0;

            $stmt = $conn->prepare("UPDATE Hotels SET Aankomst = ?, Vertrek = ?, Prijs = ?, AantalPersonen = ?, Tickets = ? WHERE id = ?");
            $stmt->execute([$aankomst, $vertrek, $prijs, $aantalPersonen, $tickets, $id]);
        }
    } elseif ($actie == 'delete') {
        $id = $_POST['id'];

        if ($entity == 'flight') {
            $stmt = $conn->prepare("DELETE FROM Flights WHERE id = ?");
            $stmt->execute([$id]);
        } elseif ($entity == 'hotel') {
            $stmt = $conn->prepare("DELETE FROM Hotels WHERE id = ?");
            $stmt->execute([$id]);
        }
    }

    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Vluchten en Hotels</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <h1>Admin Panel</h1>

    <section>
        <h2>Vluchten beheren</h2>
        <?php foreach ($vluchten as $vlucht): ?>
            <form method="post" style="display:inline-block; margin-bottom: 10px;">
                <input type="hidden" name="entity" value="flight">
                <input type="hidden" name="actie" value="update">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($vlucht['id']); ?>">

                <input type="text" name="Takeoff" value="<?php echo htmlspecialchars($vlucht['Takeoff']); ?>" required>
                <input type="text" name="Landing" value="<?php echo htmlspecialchars($vlucht['Landing']); ?>" required>
                <input type="text" name="Duration" value="<?php echo htmlspecialchars($vlucht['Duration']); ?>" required>

                <label>Datum Aankomst:
                    <input type="date" name="Date-aankomst" value="<?php echo htmlspecialchars($vlucht['Date-aankomst']); ?>" required>
                </label>
                <label>Datum Vertrek:
                    <input type="date" name="Date-vertrek" value="<?php echo htmlspecialchars($vlucht['Date-vertrek']); ?>" required>
                </label>

                <button type="submit">Opslaan</button>
            </form>

            <form method="post" style="display:inline-block; margin-left: 5px;">
                <input type="hidden" name="entity" value="flight">
                <input type="hidden" name="actie" value="delete">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($vlucht['id']); ?>">
                <button type="submit" onclick="return confirm('Weet je zeker dat je deze vlucht wilt verwijderen?');">Verwijderen</button>
            </form>
            <br>
        <?php endforeach; ?>

        <h3>Nieuwe vlucht toevoegen</h3>
        <form method="post">
            <input type="hidden" name="entity" value="flight">
            <input type="hidden" name="actie" value="toevoegen">

            <input type="text" name="Takeoff" placeholder="Vertrek" required>
            <input type="text" name="Landing" placeholder="Aankomst" required>
            <input type="text" name="Duration" placeholder="Duur" required>
            <label>Datum Aankomst:
                <input type="date" name="Date-aankomst" required>
            </label>
            <label>Datum Vertrek:
                <input type="date" name="Date-vertrek" required>
            </label>

            <button type="submit">Toevoegen</button>
        </form>
    </section>

    <hr>

    <section>
        <h2>Hotels beheren</h2>
        <?php foreach ($hotels as $hotel): ?>
            <form method="post" style="display:inline-block; margin-bottom: 10px;">
                <input type="hidden" name="entity" value="hotel">
                <input type="hidden" name="actie" value="update">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($hotel['id']); ?>">

                <label>Aankomst:
                    <input type="date" name="Aankomst" value="<?php echo htmlspecialchars($hotel['Aankomst']); ?>" required>
                </label>
                <label>Vertrek:
                    <input type="date" name="Vertrek" value="<?php echo htmlspecialchars($hotel['Vertrek']); ?>" required>
                </label>
                <label>Prijs:
                    <input type="number" step="0.01" name="Prijs" value="<?php echo htmlspecialchars($hotel['Prijs']); ?>" required>
                </label>
                <label>Aantal Personen:
                    <input type="number" name="AantalPersonen" value="<?php echo htmlspecialchars($hotel['AantalPersonen']); ?>" required>
                </label>
                <label>
                    <input type="checkbox" name="Tickets" <?php if ($hotel['Tickets']) echo 'checked'; ?>>
                    Tickets inbegrepen
                </label>
                <button type="submit">Opslaan</button>
            </form>
            <form method="post" style="display:inline-block; margin-left: 5px;">
                <input type="hidden" name="entity" value="hotel">
                <input type="hidden" name="actie" value="delete">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($hotel['id']); ?>">
                <button type="submit" onclick="return confirm('Weet je zeker dat je dit hotel wilt verwijderen?');">Verwijderen</button>
            </form>
            <br>
        <?php endforeach; ?>

        <h3>Nieuw hotel toevoegen</h3>
        <form method="post">
            <input type="hidden" name="entity" value="hotel">
            <input type="hidden" name="actie" value="toevoegen">

            <label>Aankomst:
                <input type="date" name="Aankomst" required>
            </label>
            <label>Vertrek:
                <input type="date" name="Vertrek" required>
            </label>
            <label>Prijs:
                <input type="number" step="0.01" name="Prijs" required>
            </label>
            <label>Aantal Personen:
                <input type="number" name="AantalPersonen" required>
            </label>
            <label>
                <input type="checkbox" name="Tickets">
                Tickets inbegrepen
            </label>

            <button type="submit">Toevoegen</button>
        </form>
    </section>
</body>

</html>