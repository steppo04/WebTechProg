<?php
require_once 'bootstrap.php';

header('Content-Type: application/json');

$response = ['success' => false, 'status' => ''];

if (!isUserLoggedIn() || !isset($_POST['idSpot'])) {
    echo json_encode(['success' => false, 'error' => 'Devi essere loggato']);
    exit;
}

$idSpot = $_POST['idSpot'];
$username = $_SESSION['username'];

try {
    $giaSalvato = $dbh->isSpotPreferito($username, $idSpot);

    if ($giaSalvato) {
        $dbh->rimuoviPreferito($username, $idSpot);
        $response['status'] = 'removed';
    } else {
        $dbh->aggiungiPreferito($username, $idSpot);
        $response['status'] = 'added';
    }

    $response['success'] = true;

} catch (Exception $e) {
    $response['error'] = 'Errore server: ' . $e->getMessage();
}

echo json_encode($response);
?>