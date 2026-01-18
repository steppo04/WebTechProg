<?php
    require_once 'bootstrap.php';

    if(!isUserLoggedIn()){
        header("location: login.php");
        exit;
    }

    $templateParams["titolo"] = "Spotted - I miei Preferiti";
    $templateParams["nome"] = "lista-preferiti.php";

    $username = $_SESSION["username"];

    $templateParams["spot"] = $dbh->getUserFavorites($username);

    require 'template/base.php';
?>