<section class="container mt-5">

    <?php if (isset($templateParams["titolo"])): ?>
        <div class="row mb-4 border-bottom pb-4">
            <div class="col-12 text-center">
                <h1 class="display-6"><?php echo $templateParams["titolo"]; ?></h1>
            </div>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <form action="lista-categoria.php" method="GET" id="form-ricerca">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-8">
                        <div class="d-flex gap-2" role="search">
                            <label for="ricerca" class="visually-hidden">Ricerca</label>
                            <input type="text" class="form-control form-control-lg" name="ricerca" id="ricerca"
                                placeholder="Cerca uno spot..."
                                value="<?php echo isset($_GET['ricerca']) ? htmlspecialchars($_GET['ricerca']) : ''; ?>">

                            <button type="button" class="btn btn-outline-dark d-flex gap-2 align-items-center" data-bs-toggle="modal" data-bs-target="#modalFiltri">
                                <span class="bi bi-funnel"></span> Filtri
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalFiltri" tabindex="-1" role="dialog" aria-labelledby="modalFiltriLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title fs-5" id="modalFiltriLabel">Filtra per Categoria</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Seleziona una o più categorie:</p>
                                <?php foreach ($templateParams["categorie"] as $categoria): ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input check-filtro" type="checkbox" name="cat[]"
                                            value="<?php echo $categoria['idCategoria']; ?>"
                                            id="cat<?php echo $categoria['idCategoria']; ?>"
                                            <?php if (isset($_GET["cat"]) && in_array($categoria['idCategoria'], $_GET["cat"])) echo "checked"; ?>>
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

    <div class="row g-4 mb-4" id="container-spot">
        <?php if (count($templateParams["spot"]) > 0): ?>
            <?php foreach ($templateParams["spot"] as $spot): ?>
                <div class="col-12 col-md-6 col-lg-4 spot-item" data-id="<?php echo $spot['idSpot']; ?>">
                    <article class="card h-100 shadow-sm card-spot">
                        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                            <h2 class="card-title mb-0 fs-5 text-truncate" style="max-width: 80%;">
                                <?php echo htmlspecialchars($spot["titolo"]); ?>
                            </h2>

                            <?php
                            $isPreferito = false;
                            if (isUserLoggedIn()) {
                                $isPreferito = $dbh->isSpotPreferito($_SESSION["username"], $spot["idSpot"]);
                            }

                            $iconaClass = $isPreferito ? "bi-bookmark-fill" : "bi-bookmark";
                            ?>

                            <?php if (isUserLoggedIn()): ?>
                                <button type="button" class="btn btn-link text-white p-0 btn-toggle-preferito"
                                    data-id="<?php echo $spot['idSpot']; ?>"
                                    title="Salva nei preferiti">
                                    <span class="bi <?php echo $iconaClass; ?> fs-4"></span>
                                </button>
                            <?php else: ?>
                                <a href="login.php" class="text-white" title="Accedi per salvare">
                                    <span class="bi bi-bookmark fs-4"></span>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted small"><span class="bi bi-chat-left-text" aria-hidden="true"></span> Spot:</p>
                            <p class="card-text"><?php echo htmlspecialchars($spot["testo"]); ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="dettaglio-spot.php?id=<?php echo $spot['idSpot']; ?>" class="btn btn-outline-primary btn-sm" aria-label="Leggi di più sullo spot: <?php echo htmlspecialchars($spot['titolo']); ?>">Leggi di più</a>
                        </div>
                    </article>
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

<script src="js/lista-spot.js"></script>