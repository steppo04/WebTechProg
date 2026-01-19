<?php
require_once 'bootstrap.php';

// Base Template
$templateParams["titolo"] = "Spotted - Dettaglio spot";
$templateParams["nome"] = "spot.php";

$idSpot = $_GET["id"] ?? null;
$idRisposta = $_GET["rspTo"] ?? null;


if (empty($idSpot) || !$dbh->isSpotActive($idSpot)) {
    header("Location: index.php");
    exit(); 
}

if (!empty($idRisposta)) {
    if (!$dbh->checkCommentBelongsToSpot($idRisposta, $idSpot)) {
        header("Location: dettaglio-spot.php?id=" . $idSpot);
        exit();
    }

    $commentoPadre = $dbh->getCommentById($idRisposta);
    if($commentoPadre){
         $templateParams["rispostaAPadre"] = $commentoPadre;
    }
}

$templateParams["spot"] = $dbh->getSpotInfo($idSpot);
$templateParams["commenti"] = $dbh->getComments($idSpot);

$templateParams["isPreferito"] = false; 

if(isUserLoggedIn()){
    $templateParams["isPreferito"] = $dbh->isSpotPreferito($_SESSION["username"], $idSpot);
}

require 'template/base.php';
?>