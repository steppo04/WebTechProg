<?php
require_once 'bootstrap.php';

$ricerca = isset($_GET["ricerca"]) ? $_GET["ricerca"] : "";
$categorie = isset($_GET["cat"]) ? $_GET["cat"] : [];

$spots = [];

if (!empty($ricerca) && !empty($categorie)) {
    $spots = $dbh->getSpotsByCategoriesAndString($ricerca, $categorie);
} elseif (!empty($ricerca)) {
    $spots = $dbh->getSpotsByString($ricerca);
} elseif (!empty($categorie)) {
    $spots = $dbh->getSpotsByCategories($categorie);
} else {
    $spots = $dbh->getLastSpots();
}

$isLogged = isUserLoggedIn();
foreach ($spots as &$spot) {
    $spot['isUserLoggedIn'] = $isLogged;
    $spot['isPreferito'] = false;
    
    if ($isLogged) {
        $spot['isPreferito'] = $dbh->isSpotPreferito($_SESSION["username"], $spot["idSpot"]);
    }
}

header('Content-Type: application/json');
echo json_encode($spots);
?>