<?php
require_once 'bootstrap.php';


$idCategoria = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
$sottocategorie = [];

if ($idCategoria > 0) {
    $sottocategorie = $dbh->getSubcategoriesByCategory($idCategoria);
}

// manderò al browser un JSON 
header('Content-Type: application/json');
echo json_encode($sottocategorie);
?>