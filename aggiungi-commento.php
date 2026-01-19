<?php
require_once 'bootstrap.php';

if(!isUserLoggedIn() || !isset($_POST["idSpot"]) || !isset($_POST["testo"])) {
    header("location: index.php");
    exit();
}

$idSpot = $_POST["idSpot"];
$testo = $_POST["testo"];
$idCommentoRisposto = !empty($_POST["idCommentoRisposto"]) ? $_POST["idCommentoRisposto"] : null;
$usernameUtente = $_SESSION["username"];


$dbh->insertComment($usernameUtente, $idSpot, $testo, $idCommentoRisposto);

if ($idCommentoRisposto != null) {
    $commentoOriginale = $dbh->getCommentById($idCommentoRisposto);
    
    if ($commentoOriginale && isset($commentoOriginale["usernameUtente"])) {
        $destinatario = $commentoOriginale["usernameUtente"];

        if ($destinatario != $usernameUtente) {
            $testoNotifica = "$usernameUtente ha risposto al tuo commento nello spot #$idSpot";
            $link = "dettaglio-spot.php?id=$idSpot";
            $dbh->insertNotification($destinatario, $testoNotifica, $link);
        }
    }
}

header("location: dettaglio-spot.php?id=" . $idSpot);
?>