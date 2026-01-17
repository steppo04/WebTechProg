<?php
require_once '../bootstrap.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $cognome = trim($_POST["cognome"]);
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($nome) || empty($cognome) || empty($username) || empty($password)) {
        $_SESSION['error_message'] = "Errore: Tutti i campi sono obbligatori.";
        header("Location: ../sign-up.php");
        exit;
    }

    if (strlen($password) < 8) {
        $_SESSION['error_message'] = "Errore: La password deve essere di almeno 8 caratteri.";
        header("Location: ../sign-up.php");
        exit;
    }

    $result = $dbh->insertUser($nome, $cognome, $username, $password);

    if ($result) {
        header("Location: ../login.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Errore: Registrazione fallita. Username potrebbe essere già in uso.";
        header("Location: ../sign-up.php");
        exit;
    }
} else {
    header("Location: ../sign-up.php");
    exit;
}
?>