<?php
require_once 'bootstrap.php';

if (!isAdminLoggedIn()) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

$idCommento = $_POST["id"] ?? null;
$idSpot = $_POST["idSpot"] ?? null;

if (!empty($idCommento) && !empty($idSpot)) {
    
    $dbh->deleteComment($idCommento);
    
    setMsg("Commento eliminato con successo.", "success");
    header("Location: dettaglio-spot.php?id=" . $idSpot);
    exit();
    
} else {
    setMsg("Errore durante l'eliminazione.", "danger");
    header("Location: index.php");
    exit();
}
?>