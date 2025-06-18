<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=header, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>KnDair</title>
</head>

<body>
    <header>
        <?php include('./includes/header.php') ?>
    </header>
    <main>
        <h1>Reviews</h1>

        <form name="createReview" action="./dbcalls/create_review.php" method="post">
            <input type="text" name="username" placeholder="gebruikersnaam" required>
            <textarea name="review" placeholder="Schrijf je review hier" required></textarea>
            <button type="submit">Review plaatsen</button>
        </form>

        <?php 

        include('./dbcalls/read_review.php');

        foreach ($result as $value){
            echo '<div class="review-container">';
            echo '<br> ' . $value['username'];
            echo '<br> ' . $value['review'];
            echo '</div>';
        }   
        
        ?>
    </main>
    <footer>
            <?php include('./includes/footer.php') ?>
    </footer>
</body>

</html>