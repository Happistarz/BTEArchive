<?php
require('models/Database.php');

if (isset($_POST['submit'])) {

    if (!empty($_POST["login"]) && !empty($_POST["password"])) {

        $username = htmlspecialchars($_POST["login"]);
        $password = hash("sha256", htmlspecialchars($_POST["password"]));

        $conn = new Connexion();
        $res = $conn->read("USERS", array("LOGIN = '$username'", "PASSWORD = '$password'"));
        $conn->close();

        if (count($res) > 0) {
            // Set la session et redirige vers l'index
            $_SESSION['ID'] = $res[0]['ID'];
            $_SESSION['logged'] = true;
            $_SESSION['login'] = $res[0]['LOGIN'];
            header('Location: index.php');
            exit();
        } else {
            $loginError = "Login ou mot de passe incorrect";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php //require('vue/loader.php');
    require('vue/header.php') ?>
    <main class="loginmain">
        <form action="" method="post" class="login">
            <h1>ADMINISTRATION</h1>
            <hr style="width:60%;background:blue;height:2px">
            <input type="text" name="login" id="login" required placeholder="Identifiant">
            <input type="password" name="password" id="password" required placeholder="Mot de passe">
            <input type="submit" value="Se connecter" name="submit">
            <?php if (isset($loginError)) {
                echo "<p style='color:red;text-align:center;'>$loginError</p>";
            } ?>
        </form>
    </main>
</body>

</html>