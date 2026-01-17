<section class="container mt-5">
    <div class="row">
        
        <div class="col-md-8">
            <article class="card shadow-sm mb-4" >

                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <h1 class="h4"><?php echo htmlspecialchars($templateParams["spot"]["titolo"]); ?></h1>
                    <span class="badge bg-light text-danger">#<?php echo $templateParams["spot"]["idSpot"]; ?></span>
                </div>
                
                <div class="card-body">
                    <p class="lead border-bottom pb-3">
                        <?php echo htmlspecialchars($templateParams["spot"]["testo"]); ?>
                    </p>

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <h2 class="h6 text-muted small fw-bold">Dettagli Pubblicazione</h2>
                            <ul class="list-unstyled">
                                <li><strong>Autore:</strong> <?php echo htmlspecialchars($templateParams["spot"]["nomeAutore"] . " " . $templateParams["spot"]["cognomeAutore"]); ?></li>
                                <li><strong>Data:</strong> <?php echo date("d/m/Y H:i", strtotime($templateParams["spot"]["dataInserimento"])); ?></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <h2 class="h6 text-muted small fw-bold">Classificazione</h2>
                            <ul class="list-unstyled">
                                <li><strong>Categoria:</strong> <span class="badge bg-secondary"><?php echo htmlspecialchars($templateParams["spot"]["nomeCategoria"]); ?></span></li>
                                <li><strong>Sottocategoria:</strong> <?php echo htmlspecialchars($templateParams["spot"]["nomeSottoCategoria"] ?? 'Nessuna'); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-transparent">
                    <a href="lista-categoria.php" class="btn btn-outline-secondary btn-sm">Torna alla lista</a>
                </div>
            </article>
        </div>

    </div>
</section>