<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Spotted - Lista spotted";
$templateParams["nome"] = "lista-spot.php";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["spotcasuali"] = $dbh->getLastSpots(5);

require 'template/base.php';
?>