<?php
session_start();
if(isset($_SESSION['username']))
{
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
            <h2>Type the flight information here</h2>
            <form action="./dbcalls/create.php" method="post">
                <label for="takeoff">Type the takeoff airport here:</label>
                <input type="text" name="Takeoff" id="takeoff">

                <label for="landing">Type the landing airport here:</label>
                <input type="text" name="Landing" id="landing">

                <label for="duration">Type the duration of the flight here:</label>
                <input type="text" name="Duration" id="duration">

                <input type="submit" value="Submit">
            </form>
        </section>

        <h2>Update/Delete</h2>
        <section class="admin">
            <?php
            include("./dbcalls/conn.php");
            include('./dbcalls/read.php');

            foreach ($result as $value) {
            ?>
                <form action="./dbcalls/update.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                    
                    <input type="text" name="Takeoff" value="<?php echo $value['Takeoff']; ?>">
                    <input type="text" name="Landing" value="<?php echo $value['Landing']; ?>">
                    <input type="text" name="Duration" value="<?php echo $value['Duration']; ?>">
                    
                    <button type="submit">Update</button>
                </form>

                <form action="./dbcalls/delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                    <input type="submit" value="Delete">
                </form>
            <?php
            }
            ?>
        </section>

        <a class="active" href="index.php">Home</a>

    </main>

    <?php include('./includes/footer.php'); ?>

</body>

</html>

<?php
}
else {
    header("location: ../index.php");
}
?>
