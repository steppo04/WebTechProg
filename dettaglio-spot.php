<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Spotted - Dettaglio spot";
$templateParams["nome"] = "spot.php";

$idSpot = $_GET["id"];

if (!empty($idSpot)) {
    $templateParams["spot"] = $dbh->getSpotInfo($idSpot);
    $templateParams["commenti"] = $dbh->getComments($idSpot);
}

require 'template/base.php';
?>