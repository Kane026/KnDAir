<?php
// Database connectie
try {
    $conn = new PDO("mysql:host=mariadb;dbname=KnDAir;charset=utf8", "root", "root");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Databaseconnectie mislukt: " . $e->getMessage());
}

$bericht = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST['naam'] ?? '';
    $email = $_POST['email'] ?? '';
    $bericht_text = $_POST['bericht'] ?? '';

    if ($naam != '' && $email != '' && $bericht_text != '') {
        $sql = "INSERT INTO Contact (Naam, Email, Bericht) VALUES (:naam, :email, :bericht)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':naam', $naam);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':bericht', $bericht_text);

        if ($stmt->execute()) {
            $bericht = "Bedankt voor je bericht!";
        } else {
            $bericht = "Er is iets misgegaan. Probeer het later opnieuw.";
        }
    } else {
        $bericht = "Vul alstublieft alle velden in.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contactpagina</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="contactpage-container">
    <h1>Contacteer ons</h1>

    <?php if ($bericht): ?>
        <div class="contactpage-message"><?php echo htmlspecialchars($bericht); ?></div>
    <?php endif; ?>

    <form class="contactpage-form" method="post" action="">
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" required value="<?php echo htmlspecialchars($_POST['naam'] ?? ''); ?>" />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" />

        <label for="bericht">Bericht:</label>
        <textarea id="bericht" name="bericht" required><?php echo htmlspecialchars($_POST['bericht'] ?? ''); ?></textarea>

        <input type="submit" value="Verstuur" />
    </form>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
