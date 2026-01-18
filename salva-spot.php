<?php
require_once 'bootstrap.php';

if(!isUserLoggedIn()) {
    header("location: login.php?error=Devi accedere per salvare lo spot");
    exit;
}

if(isset($_GET["id"])) {
    $idSpot = $_GET["id"];
    $username = $_SESSION["username"];
    if(!$dbh->isSpotPreferito($username, $idSpot)) {
        $dbh->aggiungiPreferito($username, $idSpot);
    } else {
        $dbh->rimuoviPreferito($username, $idSpot);
    }

    header("location: dettaglio-spot.php?id=" . $idSpot);
    exit;

} else {
    header("location: index.php");
    exit;
}

?>