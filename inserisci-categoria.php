<?php
require_once 'bootstrap.php';

if (!isAdminLoggedIn()) {
    header("Location: login.php");
    setMsg("Solo l'admin può accedere!", "danger");
    exit();
}

$templateParams["titolo"] = "Spotted - Gestione Categorie";
$templateParams["nome"] = "template/admin-categoria.php";
$templateParams["categoriePrincipali"] = $dbh->getCategoriePrincipali();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nomeInput = trim($_POST["nomeCategoria"]);
    $idPadre = $_POST["idCategoriaPadre"];

    if (strlen($nomeInput) > 0) {

        if (empty($idPadre)) {
            try {
                $dbh->insertCategoria($nomeInput);
                setMsg("Categoria Principale '$nomeInput' creata!", "success");
            } catch (Exception $e) {
                setMsg("Errore: Probabilmente la categoria esiste già.", "danger");
            }
        } else {
            try {
                $dbh->insertSottoCategoria($nomeInput, $idPadre);
                setMsg("Sottocategoria '$nomeInput' aggiunta con successo!", "success");
            } catch (Exception $e) {
                setMsg("Errore durante l'inserimento.", "danger");
            }
        }

        header("Location: inserisci-categoria.php");
        exit();
    } else {
        setMsg("Il nome non può essere vuoto.", "danger");
    }
}

require 'template/base.php';
?>