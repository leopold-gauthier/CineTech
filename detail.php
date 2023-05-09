<?php ob_start(); ?>

<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("./inc/link.inc.php") ?>
    <script src="./script/autocompletion.js" defer></script>
    <script src="./script/detail.js" defer></script>
    <title>Infos</title>
</head>

<body id="details">
    <header>
        <?php include_once("./inc/nav-inc.php") ?>
    </header>
    <main>
        <div id="detail_container">
            <div id="film-description">
                <div id="img">
                    <form method="POST">
                        <button name="favorite" type='submit'><i id="favori" class="fa-regular fa-star" style="color: #fa0000;"></i></button>
                    </form>
                </div>

                <div id="title">

                </div>
                <div id="note">
                    Note :
                </div>

                <div id="resume">

                </div>
            </div>
            <div id="commentaire">
                <div id="add">
                    <?php
                    if (isset($_SESSION['user']) != null) { ?>
                        <form method="post" action="">
                            <div class="mb-3">
                                <label class="form-label">Commenter</label><br>
                                <textarea rows="3" class="form-control" name="commentaire"></textarea>
                            </div>
                            <div class="mb-3">
                                <input class="btn btn-secondary mb-3" type="submit" name="submit" value="Envoyer le message">
                            </div>
                        </form>
                    <?php
                    } else { ?>
                        <a class="bouton" href="./index.php?connect">Se Connecter</a>
                    <?php
                    }
                    ?>
                </div>
                <?php
                $recupCommentaire = $bdd->prepare("SELECT type, id_film ,`commentaires`.`id`,`commentaires`.`id_utilisateur`, login, avatar, commentaire , date FROM commentaires  JOIN users ON users.id = commentaires.id_utilisateur WHERE id_film = ? ORDER BY date DESC");
                $recupCommentaire->execute([$_GET['id']]);
                $commentaire = $recupCommentaire->fetchAll(PDO::FETCH_ASSOC);

                for ($i = 0; $i < sizeof($commentaire); $i++) :
                ?>
                    <div class="message">
                        <h2><?php if ($commentaire[$i]['login'] === 'admin') { ?>
                            <?php
                                echo "<img src='./style/icone-utilisateur-rouge.png'>";
                            } else {
                                echo "<img src='./style/icone-utilisateur-vert.png'>";
                            }
                            ?>
                            Posté par <?= $commentaire[$i]['login'] ?> le <?= $commentaire[$i]['date'] ?>
                        </h2>
                        <textarea class="form-control" disabled><?= $commentaire[$i]['commentaire'] ?></textarea>
                        <script>

                        </script>
                        <div id="modified">
                            <?php
                            if (isset($_SESSION['user']->login) == null) {
                                echo "";
                            } elseif ($commentaire[$i]['login'] == $_SESSION['user']->login || $_SESSION['user']->login == 'admin') { ?>
                                <a href="./detail.php?id=<?= $commentaire[$i]['id_film'] ?>&type=<?= $commentaire[$i]['type'] ?>&com_id=<?= $commentaire[$i]['id'] ?>">Supprimer</a>
                            <?php
                            } elseif ($commentaire[$i]['login'] != $_SESSION['user']->login) { ?>
                                <a class="monAncre">Répondre</a>
                                <div class="maDiv" style="display:none;">
                                    <form method="POST" action="./detail.php?id=<?= $commentaire[$i]['id_film'] ?>&type=<?= $commentaire[$i]['type'] ?>&reponse=<?= $commentaire[$i]['id'] ?>">
                                        <div class="mb-3">
                                            <textarea rows="3" class="form-control" name="reponse"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <input class="btn btn-secondary mb-3" type="submit" name="submit" value="Répondre">
                                        </div>
                                    </form>
                                </div>
                            <?php }
                            ?>
                        </div>
                        <!-- //// AFFICHER REPONSE //// -->
                        <?php
                        $recupReponse = $bdd->prepare("SELECT users.login, users.avatar, reponses.id, reponses.id_utilisateur,reponses.id_commentaire, reponses.reponse, reponses.date_reponse FROM reponses JOIN users ON reponses.id_utilisateur = users.id JOIN commentaires ON reponses.id_commentaire = commentaires.id ORDER BY date_reponse DESC;");
                        $recupReponse->execute([]);
                        $reponse = $recupReponse->fetchAll();

                        for ($a = 0; $a < sizeof($reponse); $a++) :
                            if ($reponse[$a]['id_commentaire'] == $commentaire[$i]['id']) {

                        ?>
                                <div class="reponse">
                                    <h2><?php if ($reponse[$a]['login'] === 'admin') {
                                            echo "<img src='./style/icone-utilisateur-rouge.png'>";
                                        } else {
                                            echo "<img src='./style/icone-utilisateur-vert.png'>";
                                        }
                                        ?>
                                        Réponse de <?= $reponse[$a]['login'] ?> le <?= $reponse[$a]['date_reponse'] ?>
                                    </h2>
                                    <p>
                                        <i>
                                            <?= $reponse[$a]['reponse'] ?>
                                        </i>
                                    </p>
                                    <div id="modified">
                                        <?php
                                        if (isset($_SESSION['login']) == null) {
                                            echo "";
                                        } elseif ($reponse[$a]['login'] === $_SESSION['login'] || $_SESSION['login'] === 'admin') { ?>
                                            <a href="./delete_rep.php?id=<?= $reponse[$a]['id'] ?>">Supprimer</a>
                                            |
                                            <a href="./reponse.php?edit=<?= $reponse[$a]['id'] ?>">Editer</a>
                                        <?php
                                        } elseif ($reponse[$a]['login'] != $_SESSION['login']) {
                                            echo "";
                                        }
                                        ?>
                                    </div>
                                </div>

                        <?php
                            }
                        endfor;

                        ?>

                    </div>
                <?php
                endfor;
                ?>
            </div>
        </div>
    </main>
</body>

</html>

<?php

// BACKEND


// ///////////////////////////////////// FAVORITE ////////////////////////////////////////////////////
if (isset($_SESSION['user'])) {


    $recup = $bdd->prepare("SELECT * FROM `favoris` WHERE id_utilisateur = ? AND id_film = ?");
    $recup->execute([$_SESSION['user']->id, $_GET['id']]);
    $favoris = $recup->fetch(PDO::FETCH_ASSOC);


    // REQUETE
    if (isset($_POST['favorite'])) {


        $id_film = $_GET['id'];
        $type = $_GET['type'];
        $id_utilisateur = $_SESSION['user']->id;

        if (empty($favoris)) {
            $stmt = $bdd->prepare("INSERT INTO favoris (`id_film` ,`type` ,`id_utilisateur` ) VALUES (?,?,?) ");
            $stmt->execute(array($id_film, $type, $id_utilisateur));
            header('Location: ./detail.php?id=' . $_GET['id'] . '&type=' . $_GET['type'] . '');
        } else {
            $stmt = $bdd->prepare("DELETE FROM favoris WHERE id_utilisateur = ? AND id_film = ?");
            $stmt->execute(array($id_utilisateur, $id_film));
            header('Location: ./detail.php?id=' . $_GET['id'] . '&type=' . $_GET['type'] . '');
        }
    }
    // ICONE
    if (empty($favoris)) {
?>
        <script>
            var iconeFavori = document.getElementById("favori");
            console.log(iconeFavori.className);
            iconeFavori.className = "fa-regular fa-star";
        </script>
    <?php
    } else {
    ?>
        <script>
            var iconeFavori = document.getElementById("favori");

            iconeFavori.className = "fa-solid fa-star";
        </script>
<?php
    }
}
////////////////////////////////////////// REPONSE ///////////////////////////////////////////////////

if (isset($_POST['reponse'])) {
    $id_commentaire = $_GET['reponse'];
    $reponse = $_POST['reponse'];
    $id_utilisateur = $_SESSION['user']->id;
    $date = date("Y-m-d H:i:s");
    if (!empty($reponse)) {
        $getUser = $bdd->prepare("INSERT INTO reponses (reponse, id_utilisateur ,id_commentaire ,date_reponse) VALUES (?,?,?,?)");
        $getUser->execute([$reponse, $id_utilisateur, $id_commentaire, $date]);
        $message = "Votre message a bien été posté";
        header('Location: ./detail.php?id=' . $_GET['id'] . '&type=' . $_GET['type'] . '');
    }
} else {
    $message = "Veuillez écrire un commentaire";
}




///////////////////////////////// POSTER UN COMMMENTAIRE /////////////////////////////////////////////


if (isset($_POST['commentaire'])) {
    $id_utilisateur = $_SESSION['user']->id;
    $commentaire = $_POST['commentaire'];
    $date = date("Y-m-d H:i:s");
    if (!empty($commentaire)) {
        $getUser = $bdd->prepare("INSERT INTO commentaires (commentaire, id_utilisateur, id_film ,type,date) VALUES (?,?,?,?,?)");

        $getUser->bindValue(":id_utilisateur", $id_utilisateur);
        $getUser->execute([$commentaire, $id_utilisateur, $_GET['id'], $_GET['type'], $date]);
        $message = "Votre message a bien été posté";
        header('Location: ./detail.php?id=' . $_GET['id'] . '&type=' . $_GET['type'] . '');
    }
} else {
    $message = "Veuillez écrire un commentaire";
}

//////////////////////////////// SUPPRIMER COMMENTAIRE ///////////////////////////////////////////////
if (isset($_GET['com_id'])) {
    if (isset($_GET['com_id']) == $commentaire[0]['id'] && isset($_SESSION['user']->id) == $commentaire[0]['id_utilisateur']) {
        if (!empty($_GET['com_id'])) {

            $suppr_id = $_GET['com_id'];
            $suppr = $bdd->prepare('DELETE FROM commentaires WHERE id = ?');
            $suppr->execute(array($suppr_id));
            header('Location: ./detail.php?id=' . $_GET['id'] . '&type=' . $_GET['type'] . '');
        } else {
        }
    } else {
    }
}
?>


<?php
if ($_GET['id'] == "") {
    header("Location: ./index.php");
} else {
    if (isset($_GET['id'])) { ?>
        <script>
            const divfilmDesc = document.getElementById('film-description');
            const divtitle = document.getElementById("title");
            const divresume = document.getElementById('resume');
            const divnote = document.getElementById('note');
            const divimg = document.getElementById('img');
            const backgroundimgURL = "https://image.tmdb.org/t/p/original/";
            const imageElem = document.createElement('img');


            function getIdMovie() {
                let URL = window.location.href;
                let shortURL = URL.split('=')[1];
                let id = shortURL.split('&')[0];
                return id;
            }


            function getTypeMovie() {
                let URL = window.location.href;
                let shortURL = URL.split('=')[2];
                let type = shortURL.split('&')[0];
                return type;
            }
            console.log(getTypeMovie());
            fetch('https://api.themoviedb.org/3/' + getTypeMovie() + '/' + getIdMovie() + '?api_key=fbb9472bd2e3a619b71b54604ea7aacc&language=fr-FR')
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    const movie = data;
                    const title = movie.title;
                    const name = movie.name;
                    const biography = movie.biography;
                    const resume = movie.overview;
                    const popularity = (Math.round(movie.popularity));
                    const id = movie.id;
                    const note = (Math.round(movie.vote_average));
                    const image = `https://image.tmdb.org/t/p/w500${movie.poster_path}`;
                    const profile = `https://image.tmdb.org/t/p/w500${movie.profile_path}`;
                    // movieElem.classList.add('movie_poster');


                    // NAME
                    if (getTypeMovie() == "movie") {
                        divtitle.append(title);
                    } else {
                        divtitle.append(name);
                    }
                    // IMAGE
                    if (getTypeMovie() == "movie" || getTypeMovie() == "tv") {
                        imageElem.src = image;
                    } else {
                        imageElem.src = profile;
                    }
                    // RESUME
                    if (getTypeMovie() == "movie" || getTypeMovie() == "tv") {
                        divresume.append(resume);
                    } else {
                        divresume.append(biography);
                    }
                    // NOTE
                    if (getTypeMovie() == "movie" || getTypeMovie() == "tv") {
                        divnote.append(note);
                    } else {
                        divnote.append(popularity);
                    }
                    divimg.append(imageElem);




                    // titleElem.textContent = title;
                    // imageElem.src = image;
                    // imageElem.dataset.id = id; // stocker l'ID du film dans un attribut personnalisé
                    // 
                    // Récupération de l'image de fond
                    const backdropPath = data.backdrop_path;
                    const backgroundImageURL = backgroundimgURL + backdropPath;

                    // Mise à jour du style de l'élément avec l'image de fond
                    document.body.style.backgroundImage = `url('${backgroundImageURL}')`;
                })
        </script>
<?php }
}
?>