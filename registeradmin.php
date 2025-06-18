<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Register - KnDair</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body class="color-login">
  <header class="header">
    <?php include('./includes/header.php'); ?>
  </header>

  <main class="login-outer">
    <div class="login-center">
      <div class="login-form-container">
        <form class="form-login" method="post" action="./dbcalls/registeradmin.php">
          <h2>Admin Registratie</h2>

          <input type="text" name="username" placeholder="Gebruikersnaam" required />
          <input type="email" name="email" placeholder="E-mailadres" required />
          <input type="password" name="password" placeholder="Wachtwoord" required />
          <input type="password" name="confirm_password" placeholder="Bevestig wachtwoord" required />
          <input type="submit" value="Registreer Admin" />
        </form>
      </div>
    </div>
  </main>
</body>
</html>


