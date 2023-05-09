<!DOCTYPE html>
<?php ob_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("./inc/link.inc.php") ?>
    <script src="./script/index.js" defer></script>
    <script src="./script/autocompletion.js" defer></script>

    <title>Accueil</title>
</head>

<body id="index">
    <header>
        <?php include_once("./inc/nav-inc.php") ?>
    </header>
    <main>
        <div id="index_container">
            <h2>EN SALLE</h2>
            <div class="affiche">
                <div class="scroll-wrapper_g" id="now">

                </div>
            </div>

            <h2>INCONTOURNABLE</h2>
            <div class="affiche">
                <div class="scroll-wrapper_d" id="top">

                </div>
            </div>

            <h2>POPULAIRE</h2>
            <div class="affiche">
                <div class="scroll-wrapper_g" id="popular">

                </div>
            </div>
        </div>
    </main>


    <!-- Connect & SignUp POP-UP-->
    <?php if (isset($_GET['connect'])) { ?>
        <div id="fonction_users">
            <?php include_once("./inc/connect-inc.php"); ?>
        </div>
    <?php
    } else if (isset($_GET['signup'])) { ?>
        <div id="fonction_users">
            <?php include_once("./inc/signup-inc.php"); ?>
        </div>
    <?php
    }
    ?>
</body>

</html>
<script>
    const afficheElems = document.querySelectorAll('.affiche');

    afficheElems.forEach(elem => {
        const wrapper = elem.parentElement;
        const scrollWidth = elem.offsetWidth - wrapper.offsetWidth;
        wrapper.addEventListener('scroll', () => {
            const scrollPos = wrapper.scrollLeft;
            const scrollPercentage = scrollPos / scrollWidth * 100;
            elem.style.transform = `translateX(-${scrollPercentage}%)`;
        });
        elem.addEventListener('mouseenter', () => {
            elem.style.animationPlayState = 'paused';
        });
        elem.addEventListener('mouseleave', () => {
            elem.style.animationPlayState = 'running';
        });
    });
</script>