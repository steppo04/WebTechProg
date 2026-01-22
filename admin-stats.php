<?php
require_once 'bootstrap.php';

if (!isAdminLoggedIn()) {
    header("location: index.php");
    setMsg("Solo un admin può accedere a questa pagina!", "danger");
    exit();
}

$templateParams["titolo"] = "Statistiche";
$templateParams["nome"] = "template/admin-stats-page.php";


$templateParams["stats"] = $dbh->getGeneralStats();
$templateParams["top_user"] = $dbh->getTopUser();
$templateParams["top_cat"] = $dbh->getTopCategory();
$templateParams["most_favorited"] = $dbh->getMostFavoritedSpot();
$templateParams["top_commenter"] = $dbh->getTopCommenter();

require 'template/base.php';
?>