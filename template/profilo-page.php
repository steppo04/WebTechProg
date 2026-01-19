<div class="container mt-5">
    <div class="row mb-5 justify-content-center">
        <div class="col-md-8 text-center">
            <div class="p-4 bg-light rounded shadow-sm border-top border-danger border-4">
                <i class="bi bi-person-circle display-1 text-danger"></i>
                <h2 class="mt-2"><?php echo htmlspecialchars($templateParams["utente"]["nome"] . " " . htmlspecialchars($templateParams["utente"]["cognome"])); ?></h2>
                <p class="text-muted">@<?php echo htmlspecialchars($templateParams["utente"]["username"]); ?></p>
                
                <?php if($templateParams["isAdminProfile"]): ?>
                    <span class="badge bg-danger mb-3">AMMINISTRATORE</span>
                <?php endif; ?>

                <?php if($templateParams["isMine"]): ?>
                    <div class="mt-2">
                        <a href="logout.php" class="btn btn-outline-danger btn-sm">Disconnetti</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if(!$templateParams["isAdminProfile"]): ?>
        <div class="row">
            <div class="col-12 mb-3">
                <h3 class="border-bottom pb-2">I miei Spotted</h3>
            </div>
            
            <?php if(count($templateParams["spots"]) > 0): ?>
                <div class="row g-4">
                    <?php foreach($templateParams["spots"] as $spot): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header bg-danger text-white">
                                    <span class="small"><?php echo htmlspecialchars($spot["nomeCategoria"]); ?></span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($spot["titolo"]); ?></h5>
                                    <p class="card-text text-truncate"><?php echo htmlspecialchars($spot["testo"]); ?></p>
                                    <div class="d-flex justify-content-between mt-3">
                                        <a href="dettaglio-spot.php?id=<?php echo $spot["idSpot"]; ?>" class="btn btn-sm btn-outline-danger">Leggi</a>
                                        <?php if($templateParams["isMine"]): ?>
                                            <span class="badge bg-secondary"><?php echo strtoupper($spot["stato"]); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center mt-4">
                    <p class="text-muted">Nessuno spot pubblicato.</p>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>