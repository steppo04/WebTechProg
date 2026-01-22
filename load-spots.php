<?php
require_once 'bootstrap.php';

if (!isset($_POST['lastId'])) {
    echo json_encode(['html' => '', 'count' => 0, 'hasMore' => false]);
    exit;
}

$lastId = intval($_POST['lastId']);
$limit = 5;

$newSpots = $dbh->getSpotsAfterId($lastId, $limit);

$html = '';

foreach ($newSpots as $spot) {
    $isPreferito = false;
    if (isUserLoggedIn()) {
        $isPreferito = $dbh->isSpotPreferito($_SESSION["username"], $spot["idSpot"]);
    }
    $iconaClass = $isPreferito ? "bi-bookmark-fill" : "bi-bookmark";

    $html .= '<div class="col-12 col-md-6 col-lg-4 spot-item mb-4" data-id="' . $spot['idSpot'] . '">';
    $html .= '  <div class="card h-100 shadow-sm card-spot">';

    $html .= '      <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">';

    $html .= '          <h2 class="card-title mb-0 fs-5 text-truncate" style="max-width: 80%;">' . htmlspecialchars($spot["titolo"]) . '</h2>';

    if (isUserLoggedIn()) {
        $html .= '      <button type="button" class="btn btn-link text-white p-0 btn-toggle-preferito" 
                                data-id="' . $spot['idSpot'] . '" 
                                title="Salva nei preferiti">';
        $html .= '          <span class="bi ' . $iconaClass . ' fs-4"></span>';
        $html .= '      </button>';
    } else {
        $html .= '      <a href="login.php" class="text-white" title="Accedi per salvare">';
        $html .= '          <span class="bi bi-bookmark fs-4"></span>';
        $html .= '      </a>';
    }
    $html .= '      </div>';

    $html .= '      <div class="card-body">';
    $html .= '          <p class="card-text text-muted small"><span class="bi bi-chat-left-text"></span> Spot:</p>';
    $html .= '          <p class="card-text">' . htmlspecialchars($spot["testo"]) . '</p>';
    $html .= '      </div>';

    $html .= '      <div class="card-footer bg-transparent border-top-0">';
    $html .= '          <a href="dettaglio-spot.php?id=' . $spot['idSpot'] . '" class="btn btn-outline-primary btn-sm">Leggi di più</a>';
    $html .= '      </div>';

    $html .= '  </div>';
    $html .= '</div>';
}

header('Content-Type: application/json');
echo json_encode([
    'html' => $html,
    'count' => count($newSpots),
    'hasMore' => count($newSpots) >= $limit
]);
?>