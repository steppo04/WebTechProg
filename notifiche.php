<?php
require_once 'bootstrap.php';

if(!isUserLoggedIn()){
    header("location: login.php");
    exit();
}

$dbh->markNotificationsAsRead($_SESSION["username"]);

$templateParams["titolo"] = "Spot The Bug - Notifiche";
$templateParams["nome"] = "template/notifiche-page.php";
$templateParams["notifiche"] = $dbh->getUserNotifications($_SESSION["username"]);


require 'template/base.php';
?>