<?php
require_once 'bootstrap.php';

if (!isAdminLoggedIn()) {
    header("location: index.php");
    setMsg("Pagina riservata agli admin!", "danger");
    exit();
}


if (isset($_POST["idSpot"]) && isset($_POST["azione"])) {
    $stato = ($_POST["azione"] == "approva") ? "approvato" : "rifiutato";
    $dbh->updateSpotStatus($_POST["idSpot"], $stato, $_SESSION["username"]);
    if($_POST["azione"] == "approva"){
        setMsg("Post approvato con successo","success");
    }else{
        setMsg("Post rifiutato con successo","success");
    }
}

$templateParams["titolo"] = "Revisione Spot";
$templateParams["nome"] = "template/revisione-page.php";
$templateParams["spotInAttesa"] = $dbh->getPendingSpots();

require 'template/base.php';
?>