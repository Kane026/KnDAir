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
        <section class="head">
            <div class="banner-video">
                <video class="header-video" autoplay muted loop playsinline>
                    <source src="assets/video/theme-park.mp4" type="video/mp4">
                </video>
                <div class="video-overlay-content">
                    <h1 class="video-title">KND AIR</h1>
                    <button class="fill-button">Boek hier</button>
                </div>
            </div>
            <div class="zoekbalk-containter">
                <div class="zoekbalk-reizen">
                    <div class="zoekbalk">
                        <form class="zoekformulier" action="dbcalls/search.php" method="GET">
                            <div class="reisoptie">
                                <label>
                                    <input type="radio" name="reis" value="retour" checked>
                                    Retour
                                </label>
                                <label>
                                    <input type="radio" name="reis" value="enkele">
                                    Enkele reis
                                </label>
                            </div>
                            <div class="inputvelden-reis">
                                <div class="van-naar-veld">
                                    <input type="text" name="van" placeholder="Vanaf" autocomplete="off" >
                                    <input type="text" name="naar" placeholder="Naar" autocomplete="off" >
                                </div>
                                <div class="aantal-personen-veld">
                                    <input type="number" name="aantalpersonen" min="1" max="10" placeholder="Aantal Personen" autocomplete="off">
                                </div>
                                <div class="datum-velden">
                                    <input type="date" name="vertrek">
                                    <input type="date" name="terugkomst">
                                </div>
                            </div>
                            <div class="zoekknop">
                                <button type="submit">Zoeken</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
        <div class="populaire-bestemmingen-container">
            <h1 class="populaire-bestemmingen-text">Populaire bestemmingen</h1>
            <div class="pop-bes-images-row-one">
                <div class="tokyo-container-home">
                    <a href="locaties/japan-info.php"><img src="assets/img/tokyo.png" alt="" class="tokyo-img"></a>
                    <h1 class="text-bestemming-home">Tokyo</h1>
                </div>
                <div class="florida-container-home">
                    <a href="locaties/florida-info.php"><img src="assets/img/florida.png" alt="" class="florida-img"></a>
                    <h1 class="text-bestemming-home">Florida</h1>
                </div>
            </div>
            <div class="pop-bes-images-row-two">
                <div class="parijs-container-home">
                    <a href="locaties/parijs-info.php"><img src="assets/img/parijs.png" alt="" class="parijs-img"></a>
                    <h1 class="text-bestemming-home">Parijs</h1>
                </div>
                <div class="spanje-container-home">
                    <a href="locaties/spanje-info.php"><img src="assets/img/spanje.png" alt="" class="spanje-img"></a>
                    <h1 class="text-bestemming-home">Spanje</h1>
                </div>
                <div class="duitsland-container-home">
                    <a href="locaties/duitsland-info.php">><img src="assets/img/duitsland.png" alt="" class="duitsland-img"><a>
                    <h1 class="text-bestemming-home">Duitsland</h1>
                </div>
            </div>
        </div>
        <section class="accommodatie">
            <h1>Zoek op accommodatietypes</h1>
            <div class="accommodatie-fotos">
                <div class="hotel-container-home">
                    <img src="assets/img/hotel-home.png" alt="" class="hotel-home-img">
                    <h1 class="text-accommodatie-home">Hotels</h1>
                </div>
                <div class="resorts-container-home">
                    <img src="assets/img/resorts-home.png" alt="" class="resorts-home-img">
                    <h1 class="text-accommodatie-home">Resorts</h1>
                </div>
                <div class="villa-container-home">
                    <img src="assets/img/villa-home.png" alt="" class="villa-home-img">
                    <h1 class="text-accommodatie-home">Villa's</h1>
                </div>
            </div>
            <button class="bekijk-accommodatie">Bekijk alle accommodaties >></button>
        </section>
    </main>

    <footer>
    <?php include('./includes/footer.php') ?>
    </footer>
</body>

</html>