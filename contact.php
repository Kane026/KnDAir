<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $naam = $_POST['fname'] ?? '';
    $email = $_POST['email'] ?? '';
    $bericht = $_POST['subject'] ?? '';

    // ✅ Juiste verbinding voor jouw omgeving (zoals in admin page)
    $conn = new mysqli("mariadb", "root", "root", "KnDAir");

    if ($conn->connect_error) {
        $message = "<p style='color: red;'>Verbinding mislukt: " . $conn->connect_error . "</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO Contact (Naam, Email, Bericht) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $naam, $email, $bericht);
            if ($stmt->execute()) {
                $message = "<p style='color: green;'>Bedankt voor je bericht, $naam!</p>";
            } else {
                $message = "<p style='color: red;'>Fout bij opslaan: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            $message = "<p style='color: red;'>Fout bij voorbereiden statement: " . $conn->error . "</p>";
        }
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KnDAir Contact</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
  <header>
    <?php include('./includes/header.php'); ?>
  </header>

  <main>
    <div class="container-contact">
      <?php if (!empty($message)) echo $message; ?>

      <form method="POST" action="">
        <label for="fname">Full Name</label>
        <input type="text" id="fname" name="fname" placeholder="Your name.." required />

        <label for="lname">Email</label>
        <input type="email" id="lname" name="email" placeholder="Your email.." required />

        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px" required></textarea>

        <input type="submit" value="Submit" />
      </form>
    </div>

    <div class="container-text">
      <div class="contact-text">
        <h5>You can also contact me on:</h5>
        <h5>Email: KnDAir@zuigme.com</h5>
        <h5>Phone number: 06 13062175</h5>
      </div>
    </div>
  </main>
</body>
</html>
