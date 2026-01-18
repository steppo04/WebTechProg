<?php
require_once 'bootstrap.php';

if (!isUserLoggedIn()) {
    header("location: index.php");
    exit();
}

$commento = $_POST["testo"];
$idSpot = $_POST["idSpot"];
if(isset($commento) && $commento!=""){
    $dbh->insertComment($_SESSION["username"],$idSpot,$commento);
    header("location: dettaglio-spot.php?id=".$idSpot);
}

?>