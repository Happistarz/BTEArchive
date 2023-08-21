<?php

session_start();
session_destroy();

// Supprime les variables de session
unset($_SESSION['logged']);
unset($_SESSION['login']);
unset($_SESSION['ID']);


header('Location: index.php');
exit();
?>