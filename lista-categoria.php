<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Spotted - Lista spotted";
$templateParams["nome"] = "lista-spot.php";
$templateParams["categorie"] = $dbh->getCategories();

$ricerca = isset($_GET["ricerca"]) ? $_GET["ricerca"] : "";
$categorie = isset($_GET["cat"]) ? $_GET["cat"] : [];

if (!empty($ricerca) && !empty($categorie)) {
    $templateParams["spot"] = $dbh->getSpotsByCategoriesAndString($ricerca, $categorie);
} elseif (!empty($ricerca)) {
    $templateParams["spot"] = $dbh->getSpotsByString($ricerca);
} elseif (!empty($categorie)) {
    $templateParams["spot"] = $dbh->getSpotsByCategories($categorie);
} else {
    $templateParams["spot"] = $dbh->getLastSpots(10);
}

require 'template/base.php';
?>