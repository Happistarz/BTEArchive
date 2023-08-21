<?php
require('models/Database.php');
session_start();

// Check si le user a déjà essayé de se connecter 3 fois dans les 60 dernières secondes
if(isset($_SESSION['login_attempt']) && $_SESSION['login_attempt'] >= 3 && time() - $_SESSION['login_attempt_time'] < 60){
    $time = 60 - (time() - $_SESSION['login_attempt_time']);
    echo "Vous avez atteint le nombre maximal de tentatives de connexion. Veuillez réessayer dans $time secondes";
    exit();
}

if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {

    // Check si le login et le mot de passe sont corrects
    $login = htmlspecialchars($_POST['login']);
    $password = hash('sha256',htmlspecialchars($_POST['password']));
    $conn = new Connexion();
    $res = $conn->read("LOGIN",array("LOGIN = $login","PASSWORD = $password"));
    
    if($res){
        // Set la session et redirige vers l'index
        $_SESSION['login_attempt']  = 0;
        $_SESSION['logged']         = true;
        $_SESSION['login']          = $login;
        $_SESSION['password']       = $password;
        header('Location: index.php');
        exit();
    }else{
        echo "Login ou mot de passe incorrect";

        // Si le user a déjà essayé de se connecter, on incrémente le nombre de tentatives
        $_SESSION['login_attempt'] = isset($_SESSION['login_attempt']) ? $_SESSION['login_attempt'] + 1 : 1;
        $_SESSION['login_attempt_time'] = time();
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
    <?php require('vue/loader.php');
            require('vue/header.php') ?>
    <main class="loginmain">
        <div class="login">
            <form action="login.php" method="post">
                <label for="login">Login</label>
                <input type="text" name="login" id="login" required>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                <input type="submit" value="Se connecter">
            </form>
        </div>
    </main>
</body>
</html>