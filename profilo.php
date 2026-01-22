<?php
require_once 'bootstrap.php';

if (!isUserLoggedIn() && !isAdminLoggedIn()) {
    header("location: login.php");
    setMsg("Devi prima effettuale l'accesso", "danger");
    exit();
}

$userLogged = $_SESSION["username"];
$userToShow = isset($_GET["user"]) ? $_GET["user"] : $userLogged;

$utente = $dbh->getUserInfo($userToShow);

if (!$utente) {
    header("location: index.php");
    setMsg("Devi prima effettuale l'accesso", "danger");
    exit();
}

$templateParams["utente"] = $utente;
$templateParams["isAdminProfile"] = ($utente["idTipo"] == 1);
$templateParams["spots"] = $templateParams["isAdminProfile"] ? [] : $dbh->getSpotsByUsername($userToShow);
$templateParams["isMine"] = ($userLogged == $userToShow);

$templateParams["titolo"] = "Profilo di " . htmlspecialchars($utente["username"]);
$templateParams["nome"] = "template/profilo-page.php";

require 'template/base.php';
?>