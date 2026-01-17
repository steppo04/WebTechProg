<?php
require_once 'bootstrap.php';

// controllo utente loggato
if (!isUserLoggedIn()) {
    header("location: login.php");
    exit();
}

if (isset($_SESSION["admin"]) || $_SESSION["admin"] == true) {
    header("location: index.php");
    exit();
}

$idSpot = isset($_GET["id"]) ? $_GET["id"] : null;
$spotEsistente = null;

if ($idSpot) {
    $spotEsistente = $dbh->getSpotById($idSpot);
    // Verifica che l'utente sia l'effettivo autore
    if (!$spotEsistente || $spotEsistente["usernameUtente"] != $_SESSION["username"]) {
        header("location: index.php");
        exit();
    }
}

// Gestione dell'invio del form 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $azione = $_POST["azione"];
    $titolo = $_POST["titolo"];
    $testo = $_POST["testo"];
    $idCat = $_POST["categoria"];
    $idSubCat = !empty($_POST["sottocategoria"]) ? $_POST["sottocategoria"] : null;

    if ($azione == "pubblica") {
        $dbh->insertSpot($titolo, $testo, $idCat, $idSubCat, $_SESSION["username"]);
        header("location: index.php");
        exit();
    } elseif ($azione == "modifica" && $idSpot) {
        $dbh->updateSpot($idSpot, $titolo, $testo, $idCat, $idSubCat);
        header("location: index.php?id=" . $idSpot);
        exit();
    } elseif ($azione == "elimina" && $idSpot) {
        $dbh->deleteSpot($idSpot);
        header("location: index.php");
        exit();
    }
}

$templateParams["titolo"] = "Spot The Bug - Gestione Spot";
$templateParams["nome"] = "gestione-spot-page.php";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["sottocategorie"] = $dbh->getAllSubcategories();
$templateParams["spot"] = $spotEsistente;

require 'template/base.php';
?>