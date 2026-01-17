<?php
require_once 'bootstrap.php';

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if (empty($login_result)) {
        $templateParams["errorelogin"] = "Errore! Username o password errati!";
    } else {
        registerLoggedUser($login_result);
        header("Location: index.php");
        exit;
    }
}

$templateParams["titolo"] = "Spotted - Login";
$templateParams["nome"] = "template/login-page.php";

if (isUserLoggedIn() || isAdminLoggedIn()) {
    header("Location: index.php");
    exit;
}

require 'template/base.php';
?>