<section class="container mt-5">

    <?php if(isset($templateParams["titolo"])): ?>
        <div class="row mb-4 border-bottom pb-4">
            <div class="col-12 text-center">
                <h1 class="display-6 fs-2"><?php echo $templateParams["titolo"]; ?></h1>
            </div>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">

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
                            
                            <button type="button" class="btn btn-outline-dark d-flex gap-2 align-items-center" data-bs-toggle="modal" data-bs-target="#modalFiltri">
                                <i class="bi bi-funnel"></i> Filtri
                            </button>
                        </div>
                    </div>
                </div>
            </form> 
            <div class="modal fade" id="modalFiltri" tabindex="-1" aria-labelledby="modalFiltriLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h2 class="modal-title fs-5" id="modalFiltriLabel">Filtra per Categoria</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <form action="" method="GET" id="formFiltri">
                            
                            <div class="modal-body"> <?php if(isset($_GET["ricerca"])): ?>
                                    <input type="hidden" name="ricerca" value="<?php echo htmlspecialchars($_GET["ricerca"]); ?>">
                                <?php endif; ?>

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
                                
                            </div> <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi e Applica</button>
                            </div>
                            
                        </form>
                        </div>
                </div>
            </div>
            </div>
    </div>

    <div class="row g-4 mb-4">
        <?php if(count($templateParams["spot"]) > 0): ?>
            <?php foreach($templateParams["spot"] as $spot): ?>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm card-spot">
                        <div class="card-header bg-danger text-white">
                            <h2 class="card-title mb-0 fs-5"><?php echo $spot["titolo"]; ?></h2>
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