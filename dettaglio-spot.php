<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Spotted - Dettaglio spot";
$templateParams["nome"] = "spot.php";

$idSpot = $_GET["id"] ?? null;
$idRisposta = $_GET["rspTo"] ?? null;


if (empty($idSpot) || !$dbh->isSpotActive($idSpot)) {
    header("Location: 404.php");
    exit();
}

if (!empty($idRisposta)) {
    if (!$dbh->checkCommentBelongsToSpot($idRisposta, $idSpot)) {
        header("Location: dettaglio-spot.php?id=" . $idSpot);
        setMsg("Il messaggio a cui stai rispondendo non appartiene allo spot.", "danger");
        exit();
    }

    $commentoPadre = $dbh->getCommentById($idRisposta);
    if ($commentoPadre) {
        $templateParams["rispostaAPadre"] = $commentoPadre;
    }
}

$templateParams["spot"] = $dbh->getSpotInfo($idSpot);
$templateParams["commenti"] = $dbh->getComments($idSpot);

$templateParams["isPreferito"] = false;

if (isUserLoggedIn()) {
    $templateParams["isPreferito"] = $dbh->isSpotPreferito($_SESSION["username"], $idSpot);
}

require 'template/base.php';
?>