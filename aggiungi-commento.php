<?php
require_once 'bootstrap.php';

header('Content-Type: application/json');
$response = ["success" => false, "message" => "", "data" => []];

if (!isUserLoggedIn()) {

    if(isAdminLoggedIn()){
        $response["message"] = "L'admin non può realizzare commenti";
        echo json_encode($response);
        exit();
    }else{
        $response["message"] = "Devi effettuare l'accesso.";
        echo json_encode($response);
        exit();
    }
    
}

$idSpot = $_POST["idSpot"];
$commento = $_POST["testo"];
$idCommentoRisposto = !empty($_POST["idCommentoRisposto"]) ? $_POST["idCommentoRisposto"] : null;
$usernameUtente = $_SESSION["username"];

if (isset($commento) && trim($commento) != "") {
    $newCommentId = $dbh->insertComment($_SESSION["username"], $idSpot, $commento, $idCommentoRisposto);

    //recupero dati utente
    $userData = $dbh->getUsersData($usernameUtente); 
    $fotoProfilo = !empty($userData[0]["fotoProfilo"]) ? "upload/" . $userData[0]["fotoProfilo"] : "upload/default.png";

    $responseData = [
        "idCommento" => $newCommentId,
        "username" => $usernameUtente,
        "fotoProfilo" => $fotoProfilo,
        "testo" => htmlspecialchars($commento),
        "data" => date("d/m H:i"),
        "isAdmin" => isAdminLoggedIn(),
        "idSpot" => $idSpot,
        "haRisposto" => false,
        "autorePadre" => "",
        "testoPadre" => ""
    ];

    // se sto rispondendo a qualcuno recupero i suoi dati per il JSON
    if ($idCommentoRisposto != null) {
        $commentoPadre = $dbh->getCommentById($idCommentoRisposto);
        if ($commentoPadre) {
            $responseData["haRisposto"] = true;
            $responseData["autorePadre"] = $commentoPadre["usernameUtente"];
            $responseData["testoPadre"] = htmlspecialchars($commentoPadre["testo"]);
        }
    }

    $response["success"] = true;
    $response["message"] = "Commento inserito!";
    $response["data"] = $responseData;

    //gestione notifiche
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
} else {
    $response["message"] = "Il commento non può essere vuoto.";
}

echo json_encode($response);
exit();
?>