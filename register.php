<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - KnDair</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body class="color-login">

  <header class="header">
    <?php include('./includes/header.php'); ?>
  </header>

  <main class="login-outer">
    <div class="login-center">
      <div class="login-form-container">
        <form class="form-login" method="post" action="./dbcalls/registeruser.php">
          <h2>Register</h2>

          <input type="text" name="fullname" placeholder="Full name" required />
          <input type="email" name="email" placeholder="E-mail" required />
          <input type="password" name="password" placeholder="Password" required />
          <input type="password" name="confirm_password" placeholder="Confirm password" required />
          <input type="submit" value="Registrer" />
        </form>
      </div>
    </div>
  </main>

</body>

</html>

