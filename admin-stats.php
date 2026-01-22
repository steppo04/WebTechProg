<?php
require_once 'bootstrap.php';

// controllo sempre admin 
if (!isAdminLoggedIn()) {
    header("location: index.php");
    setMsg("Solo un admin può accedere a questa pagina!", "danger");
    exit();
}

$templateParams["titolo"] = "Spot The Bug - Statistiche";
$templateParams["nome"] = "template/admin-stats-page.php";


$templateParams["stats"] = $dbh->getGeneralStats();
$templateParams["top_user"] = $dbh->getTopUser();
$templateParams["top_cat"] = $dbh->getTopCategory();
$templateParams["most_favorited"] = $dbh->getMostFavoritedSpot();
$templateParams["top_commenter"] = $dbh->getTopCommenter();

require 'template/base.php';
?>