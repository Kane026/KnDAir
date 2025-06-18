<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=header, initial-scale=1.0" />
    <title>KnDair</title>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

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

                <button id="secretAdminBtn" style="margin-top: 15px;">Admin</button>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('secretAdminBtn').addEventListener('click', function () {
            const code = prompt("Voer admincode in:");
            console.log("Ingevoerde code:", code);
            if (code === "emile") {
                alert("Code klopt! Je wordt doorgestuurd naar admin.");
                window.location.href = "admin.php";
            } else {
                alert("Ongeldige code.");
            }
        });
    </script>

</body>

</html>
