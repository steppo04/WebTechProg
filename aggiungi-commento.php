<?php
require_once 'bootstrap.php';

if (!isUserLoggedIn()) {
    header("location: index.php");
    exit();
}

$commento = $_POST["testo"];
$idSpot = $_POST["idSpot"];
$idCommentoRisposto = !empty($_POST["idCommentoRisposto"]) ? $_POST["idCommentoRisposto"] : null;

if(isset($commento) && trim($commento) != ""){
    $dbh->insertComment($_SESSION["username"], $idSpot, $commento, $idCommentoRisposto);
    header("location: dettaglio-spot.php?id=".$idSpot);
    exit();
} else {
    header("location: dettaglio-spot.php?id=".$idSpot."&error=1");
    exit();
}
?>