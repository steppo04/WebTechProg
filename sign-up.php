<?php
require_once 'bootstrap.php';

if (isUserLoggedIn() || isAdminLoggedIn()) {
    header("location: index.php");
    exit;
}

if (isset($_SESSION['error_message'])) {
    $templateParams["erroresignup"] = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

$templateParams["titolo"] = "Spotted - Sign Up";
$templateParams["nome"] = "template/sign-up-page.php";

require 'template/base.php';
?>