<?php
require_once 'bootstrap.php';

if (!isUserLoggedIn()) {
    if(!isAdminLoggedIn()){
        header("location: index.php");
        setMsg("Non puoi modificare questo spot.", "danger");
        exit();
    }
}

$idSpot = isset($_GET["id"]) ? $_GET["id"] : null;
$spotEsistente = null;

if ($idSpot) {
    $spotEsistente = $dbh->getSpotById($idSpot);
    if (!$spotEsistente || $spotEsistente["usernameUtente"] != $_SESSION["username"]) {
        if(!isAdminLoggedIn()){
            header("location: index.php");
            setMsg("Solo il proprietario può modificare il post", "danger");
            exit();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $azione = $_POST["azione"];
    $titolo = $_POST["titolo"];
    $testo = $_POST["testo"];
    $idCat = $_POST["categoria"];
    $idSubCat = !empty($_POST["sottocategoria"]) ? $_POST["sottocategoria"] : null;
    $isAnonymous = isset($_POST["isAnonymous"]) ? 1 : 0;

    if ($azione == "pubblica") {
        $dbh->insertSpot($titolo, $testo, $idCat, $idSubCat, $_SESSION["username"], $isAnonymous);
        header("location: lista-categoria.php");
        setMsg("Spot pubblicato con successo", "success");
        exit();
    } elseif ($azione == "modifica" && $idSpot) {
        $dbh->updateSpot($idSpot, $titolo, $testo, $idCat, $idSubCat, $isAnonymous);
        header("location: lista-categoria.php");
        setMsg("Spot modificato con successo, attendi approvazione admin", "success");
        exit();
    } elseif ($azione == "elimina" && $idSpot) {
        $dbh->deleteSpot($idSpot);
        header("location: lista-categoria.php");
        setMsg("Spot eliminato", "success");
        exit();
    }
}

$templateParams["titolo"] = "Spot The Bug - Gestione Spot";
$templateParams["nome"] = "gestione-spot-page.php";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["spot"] = $spotEsistente;

require 'template/base.php';
?>