<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="display-6 border-bottom pb-2">Revisione Nuovi Spot</h2>
        </div>
    </div>

    <?php if (count($templateParams["spotInAttesa"]) > 0): ?>
        <div class="row g-4">
            <?php foreach ($templateParams["spotInAttesa"] as $spot): ?>
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-danger text-white fw-bold d-flex justify-content-between">
                            <span><?php echo htmlspecialchars($spot["titolo"]); ?></span>
                            <small class="opacity-75">Inviato da: <?php echo htmlspecialchars($spot["usernameUtente"]); ?></small>
                        </div>
                        <div class="card-body">
                            <p class="mb-1 text-muted small"><strong>Categoria:</strong> <?php echo htmlspecialchars($spot["nomeCategoria"]); ?></p>
                            <p class="card-text"><?php echo htmlspecialchars($spot["testo"]); ?></p>

                            <div class="d-flex justify-content-end gap-2 mt-3">
                                <form method="POST" action="revisione.php">
                                    <input type="hidden" name="idSpot" value="<?php echo $spot["idSpot"]; ?>">
                                    <button type="submit" name="azione" value="rifiuta" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-x-circle"></i> Rifiuta
                                    </button>
                                    <button type="submit" name="azione" value="approva" class="btn btn-success btn-sm">
                                        <i class="bi bi-check-circle"></i> Approva
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center mt-5">
            <i class="bi bi-info-circle"></i> Non ci sono nuovi spot da revisionare.
        </div>
    <?php endif; ?>
</div>