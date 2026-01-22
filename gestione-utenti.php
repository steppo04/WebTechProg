<?php
require_once 'bootstrap.php';

if (!isAdminLoggedIn()) {
    header("location: index.php");
    setMsg("Solo l'admin può accedere alla pagina!", "danger");
    exit();
}

// gestione del cambio di stato
if (isset($_POST["username"]) && isset($_POST["azione"])) {
    $nuovoStato = ($_POST["azione"] == "blocca") ? "bloccato" : "attivo";
    $dbh->updateUserStatus($_POST["username"], $nuovoStato);
}

$templateParams["titolo"] = "Spot The Bug - Gestione Utenti";
$templateParams["nome"] = "gestione-utenti-page.php";
$templateParams["utenti"] = $dbh->getUsersExceptAdmins();

require 'template/base.php';
?>