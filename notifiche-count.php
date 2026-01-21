<?php
require_once 'bootstrap.php';

if (!isUserLoggedIn()) {
    echo json_encode(["count" => 0]);
    exit;
}

$unreadCount = $dbh->getUnreadNotificationsCount($_SESSION["username"]);

header('Content-Type: application/json');
echo json_encode(["count" => (int)$unreadCount]);
exit;
?>