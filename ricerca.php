<?php
require_once 'bootstrap.php';

$ricerca = $_GET["ricerca"] ?? "";
$categorie = $_GET["cat"] ?? [];


if (!empty($ricerca) && !empty($categorie)) {
    $risultati = $dbh->getSpotsByCategoriesAndString($ricerca, $categorie);
} elseif (!empty($ricerca)) {
    $risultati = $dbh->getSpotsByString($ricerca);
} elseif (!empty($categorie)) {
    $risultati = $dbh->getSpotsByCategories($categorie);
} else {
    $risultati = $dbh->getLastSpots(20);
}


header('Content-Type: application/json');
echo json_encode($risultati);
exit;
?>