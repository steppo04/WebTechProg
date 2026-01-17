<section class="container mt-5">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 col-lg-6">
            <form action="lista-categoria.php" method="GET">
        
                <div class="row justify-content-center mb-5">
                    <div class="col-md-8">
                        <div class="d-flex gap-2" role="search">
                            <label for="ricerca" class="visually-hidden">Ricerca</label>
                            <input type="text" class="form-control form-control-lg" name="ricerca" id="ricerca" 
                                placeholder="Cerca uno spot..." 
                                value="<?php echo isset($_GET['ricerca']) ? htmlspecialchars($_GET['ricerca']) : ''; ?>">
                            
                            <button type="submit" class="btn btn-danger">Cerca</button>
                            
                            <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalFiltri">
                                <i class="bi bi-funnel"></i> Filtri
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalFiltri" tabindex="-1" aria-labelledby="modalFiltriLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalFiltriLabel">Filtra per Categoria</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Seleziona una o più categorie:</p>
                                <?php foreach($templateParams["categorie"] as $categoria): ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="cat[]" 
                                            value="<?php echo $categoria['idCategoria']; ?>" 
                                            id="cat<?php echo $categoria['idCategoria']; ?>"
                                            <?php if(isset($_GET["cat"]) && in_array($categoria['idCategoria'], $_GET["cat"])) echo "checked"; ?>>
                                        <label class="form-check-label" for="cat<?php echo $categoria['idCategoria']; ?>">
                                            <?php echo $categoria['nome']; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if(isset($templateParams["titolo"])): ?>
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="display-6"><?php echo $templateParams["titolo"]; ?></h2>
            </div>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php if(count($templateParams["spot"]) > 0): ?>
            <?php foreach($templateParams["spot"] as $spot): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-danger text-white">
                            <h5 class="card-title mb-0"><?php echo $spot["titolo"]; ?></h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted small">
                                <i class="bi bi-chat-left-text"></i> Spot:
                            </p>
                            <p class="card-text"><?php echo $spot["testo"]; ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="dettaglio-spot.php?id=<?php echo $spot['idSpot']; ?>" class="btn btn-outline-primary btn-sm">
                             Leggi di più
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center my-5">
                <p class="lead">Nessuno spot trovato.</p>
                <a href="lista-categoria.php" class="btn btn-secondary">Resetta la ricerca</a>
            </div>
        <?php endif; ?>
    </div>
</section>