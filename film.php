<?php ob_start() ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include_once("./inc/link.inc.php") ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./script/autocompletion.js" defer></script>
    <script src="./script/film.js" defer></script>
    <title>Films</title>
</head>

<body>
    <header>
        <?php include_once("./inc/nav-inc.php") ?>
    </header>
    <main>
        <div id="container">
            <h1>Films populaires</h1>
            <div id="series-container"></div>
            <div id="pagination"></div>
        </div>
    </main>
    <footer>

    </footer>



</body>

</html>