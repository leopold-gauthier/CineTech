<?php
ob_start();
require_once("./inc/config.php");
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include_once("./inc/link.inc.php") ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./script/autocompletion.js" defer></script>
    <script src="./script/favoris.js" defer></script>
    <title>Mes Favoris</title>
</head>

<body>
    <header>
        <?php include_once("./inc/nav-inc.php") ?>
    </header>
    <main>
        <div id="container">
            <h1>Favoris</h1>
            <?php
            // Récupération des films favoris de la base de données pour l'utilisateur actuel
            $stmt = $bdd->prepare("SELECT id_film,type FROM favoris WHERE id_utilisateur = ? ORDER BY id DESC");
            $stmt->execute([$_SESSION['user']->id]);
            $films_favoris = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Fonction pour récupérer les informations d'un film à partir de son ID
            function getMovie($movie_id)
            {
                // Clé API TMDb
                $api_key = 'fbb9472bd2e3a619b71b54604ea7aacc';
                $fr = 'language=fr-FR';

                // URL de l'API TMDb pour récupérer les informations d'un film
                $url = "https://api.themoviedb.org/3/movie/" . $movie_id . "?api_key=" . $api_key . "&" . $fr;

                // Récupération des données JSON de l'API TMDb
                $json_data = file_get_contents($url);
                $data = json_decode($json_data, true);

                // Affichage des informations du film
                echo "<div class='favoris'>";
                echo "<h2>" . $data['title'] . "</h2>";
                echo "<img src='https://image.tmdb.org/t/p/w500/" . $data['poster_path'] . "' alt='" . $data['title'] . "'>";
                echo "</div>";
            } // Fermeture de la connexion à la base de données $pdo=null; 
            ?>
            <div id="films_favoris">
                <?php
                // Boucle à travers les ID des films favoris et affichage de leurs informations
                foreach ($films_favoris as $film_favori) {
                    getMovie($film_favori);
                }
                ?>
            </div>
        </div>
    </main>
    <footer>

    </footer>

</body>

</html>