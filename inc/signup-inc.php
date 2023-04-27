<?php ob_start(); ?>
<div>
    <form action="" method="post">
        <div class="mb-3">
            <label class="form-label" for="name">Login: </label>
            <input class="form-control" type="text" name="login" id="login">
        </div>
        <div class="mb-3">
            <label class="form-label" for="email">Email: </label>
            <input class="form-control" type="email" name="email" id="email">
        </div>

        <div class="mb-3">
            <label class="form-label" for="firstname">Firstname: </label>
            <input class="form-control" type="text" name="firstname" id="firstname">
        </div>

        <div class="mb-3">
            <label class="form-label" for="lastname">Lastname: </label>
            <input class="form-control" type="text" name="lastname" id="lastname">
        </div>

        <div class="mb-3">
            <label class="form-label" for="password">Password: </label>
            <input class="form-control" type="password" name="password" id="password">
        </div>

        <div class="mb-3">
            <label class="form-label" for="password">Password Confirm: </label>
            <input class="form-control" type="password" name="password_confirm" id="password">
        </div>
        <div class="mb-3">
            <input class="form-control" class="button" type="submit" name="submit" value="S'inscrire">
        </div>
    </form>
    <a id="fonction_close" href="?"><i class="fa-solid fa-xmark"></i></a>
</div>


<?php


if (isset($_POST['submit'])) {
    $user = new User(NULL, $_POST["login"], $_POST["password"], $_POST["email"], $_POST["firstname"], $_POST["lastname"]);
    $user->register($bdd);
    ob_end_flush();
    header('Location: ./index.php');
}
