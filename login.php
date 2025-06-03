<!DOCTYPE html>
<html lang="en">

<head>
<<<<<<< HEAD
    <meta charset="UTF-8">
    <meta name="viewport" content="width=header, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>KnDair</title>
</head>
=======
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KnDair</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

>>>>>>> 29d6d8ed78ebd167072e59efaac58f73af04a973
<body class="color-login">

  <header class="header">
    <?php include('./includes/header.php'); ?>
  </header>

  <main class="login-outer">
    <div class="login-center">
      <div class="login-form-container">
        <form class="form-login" method="post" action="./dbcalls/checklogin.php">
          <input type="text" name="username" placeholder="Gebruikersnaam" required />
          <input type="email" name="email" placeholder="E-mailadres" required />
          <input type="password" name="password" placeholder="Wachtwoord" required />
         
          <input type="submit" value="Login" />
          <button type="button" onclick="window.location.href='register.php'">Register</button>
        </form>
      </div>
    </div>
  </main>

</body>
</html>
