<?php ob_start(); ?>
<div>
    <form action="" method="post">
        <div class="mb-3">
            <label class="form-label" for="name">Utilisateurs: </label>
            <input class="form-control" type="text" name="login" id="login" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Password: </label>
            <input class="form-control" type="password" name="password" id="password" required>
        </div>
        <div class="mb-3">
            <input class="form-control" type="submit" name="submit" value="S'inscrire">
        </div>
    </form>
    <a id="fonction_close" href="?"><i class="fa-solid fa-xmark"></i></a>
</div>


<?php
if (isset($_POST['submit'])) {
    $User = new User("", $_POST["login"], $_POST["password"], "", "", "");
    $User->connect($bdd);
    ob_end_flush();
    header("Location: ./index.php");
}
?>