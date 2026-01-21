<?php
require_once 'bootstrap.php';

if (!isUserLoggedIn()) {
    header("location: dettaglio-spot.php?id=" . $_POST["idSpot"]);
    setMsg("Devi prima effettuale l'accesso", "danger");
    exit();
}

$idSpot = $_POST["idSpot"];
$commento = $_POST["testo"];
$idCommentoRisposto = !empty($_POST["idCommentoRisposto"]) ? $_POST["idCommentoRisposto"] : null;
$usernameUtente = $_SESSION["username"];

if (isset($commento) && trim($commento) != "") {
    $dbh->insertComment($_SESSION["username"], $idSpot, $commento, $idCommentoRisposto);
    setMsg("Commento inserito con successo!", "success");
} else {
    setMsg("Il commento non può essere vuoto.", "danger");
}

$spot = $dbh->getSpotById($idSpot);
if ($spot && $spot["usernameUtente"] != $usernameUtente) {
    $testoNotifica = $usernameUtente . " ha commentato il tuo spot: " . $spot["titolo"];
    $link = "dettaglio-spot.php?id=$idSpot";
    $dbh->insertNotification($spot["usernameUtente"], $testoNotifica, $link);
}

if ($idCommentoRisposto != null) {
    $commentoOriginale = $dbh->getCommentById($idCommentoRisposto);


    if ($commentoOriginale && isset($commentoOriginale["usernameUtente"])) {
        $destinatario = $commentoOriginale["usernameUtente"];

        if ($destinatario != $usernameUtente) {
            $testoNotifica = $usernameUtente . " ha risposto al tuo commento nello spot: " . $dbh->getTitoloBySpotId($idSpot);
            $link = "dettaglio-spot.php?id=$idSpot";
            $dbh->insertNotification($destinatario, $testoNotifica, $link);
        }
    }
}



header("location: dettaglio-spot.php?id=" . $idSpot);
?>