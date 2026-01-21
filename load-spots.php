<?php
require_once 'bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit; 
}

$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
$limit = 6; // Carico 6 spot alla volta 

$spots = $dbh->getSpotsPagination($offset, $limit);

if (empty($spots)) {
    echo json_encode(['html' => '', 'hasMore' => false]);
    exit;
}

$htmlOutput = '';
foreach ($spots as $spot) {
    $titolo = htmlspecialchars($spot["titolo"]);
    $testo = htmlspecialchars($spot["testo"]);
    $id = $spot['idSpot'];
    
    $htmlOutput .= '
    <div class="col-12 col-md-6 col-lg-4 spot-item">
        <div class="card h-100 shadow-sm card-spot">
            <div class="card-header bg-danger text-white d-flex align-items-center">
                <h2 class="card-title mb-0 fs-5 text-truncate">'.$titolo.'</h2>
            </div>
            <div class="card-body">
                <p class="card-text text-muted small"><i class="bi bi-chat-left-text"></i> Spot:</p>
                <p class="card-text">'.$testo.'</p>
            </div>
            <div class="card-footer bg-transparent border-top-0">
                <a href="dettaglio-spot.php?id='.$id.'" class="btn btn-outline-primary btn-sm">Leggi di più</a>
            </div>
        </div>
    </div>';
}

header('Content-Type: application/json');
echo json_encode(['html' => $htmlOutput, 'hasMore' => count($spots) === $limit]);
?>