<?php

session_start();
session_destroy();

// Supprime les variables de session
unset($_SESSION['logged']);
unset($_SESSION['login']);
unset($_SESSION['login_attempt']);
unset($_SESSION['login_attempt_time']);

header('Location: index.php.php');
exit();
?>