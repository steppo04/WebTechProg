<?php
    require_once 'bootstrap.php';

    if(!isUserLoggedIn()){
        header("location: login.php");
        exit;
    }

    $templateParams["titolo"] = "Spotted - I miei Preferiti";
    $templateParams["nome"] = "lista-preferiti.php";

    $username = $_SESSION["username"];

    $filter = $_GET["filter"] ?? "recente";

    if ($filter == "newest") {
        $templateParams["spot"] = $dbh->getUserFavorites($username, "S.dataInserimento DESC");
    } elseif ($filter == "oldest") {
        $templateParams["spot"] = $dbh->getUserFavorites($username, "S.dataInserimento ASC");
    } elseif ($filter == "az") {
        $templateParams["spot"] = $dbh->getUserFavorites($username, "S.titolo ASC");
    } else {
        $templateParams["spot"] = $dbh->getUserFavorites($username, "S.dataInserimento DESC");
    }
    require 'template/base.php';
?>