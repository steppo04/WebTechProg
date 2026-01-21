<?php
require_once 'bootstrap.php';

if (!isUserLoggedIn()) {
    header("location: login.php");
    exit();
}

$notifiche = $dbh->getUserNotifications($_SESSION["username"]);
$templateParams["notifiche"] = $notifiche;

$dbh->markNotificationsAsRead($_SESSION["username"]);

$templateParams["titolo"] = "Spot The Bug - Notifiche";
$templateParams["nome"] = "template/notifiche-page.php";

require 'template/base.php';
?>