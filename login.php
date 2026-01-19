<?php
require_once 'bootstrap.php';

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if ($login_result === -1) {
        $templateParams["errorelogin"] = "Errore! Il tuo account è stato bloccato.";
    } elseif (empty($login_result)) {
        $templateParams["errorelogin"] = "Errore! Username o password errati!";
    } else {
        registerLoggedUser($login_result);
        header("Location: index.php");
        exit;
    }
}

$templateParams["titolo"] = "Spotted - Login";
$templateParams["nome"] = "login-page.php";

if (isUserLoggedIn() || isAdminLoggedIn()) {
    header("Location: index.php");
    exit;
}

require 'template/base.php';
?>