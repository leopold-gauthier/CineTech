<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("./inc/link.inc.php") ?>
    <script src="./script/autocompletion.js" defer></script>
    <title>Infos</title>
</head>

<body id="details">
    <header>
        <?php include_once("./inc/nav-inc.php") ?>
    </header>
    <main>
        <div id="detail_container">
            <div id="film-description">
                <div id="favoris">

                </div>
                <div id="img">

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

            </div>
        </div>
    </main>

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
                    let id = URL.split('=')[1];
                    return id;
                }

                function getTypeMovie() {
                    let URL = window.location.href;
                    let type = URL.split('=')[2];
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
</body>

</html>