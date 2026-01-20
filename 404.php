<?php
require_once 'bootstrap.php';

http_response_code(404);

$templateParams["titolo"] = "Spotted - Pagina non trovata";
$templateParams["nome"] = "template/errore-404.php";

require 'template/base.php';
?>