<?php
require_once 'bootstrap.php';

if (!isUserLoggedIn()) {
    header("location: login.php");
    setMsg("Devi accedere per salvare lo spot", "danger");
    exit;
}

if (isset($_GET["id"])) {
    $idSpot = $_GET["id"];
    $username = $_SESSION["username"];
    $text = "Spot ";
    if (!$dbh->isSpotPreferito($username, $idSpot)) {
        $dbh->aggiungiPreferito($username, $idSpot);
        $text .= "salvato";
    } else {
        $dbh->rimuoviPreferito($username, $idSpot);
        $text .= " tolto dai salvati";
    }

    header("location: dettaglio-spot.php?id=" . $idSpot);
    setMsg($text . " con successo", "success");

    exit;
} else {
    header("location: index.php");
    setMsg("Errore nel salvataggio", "danger");
    exit;
}
?>