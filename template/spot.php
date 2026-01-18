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

        <div class="col-md-4 border-start">
            <aside>
                <h3 class="h5 mb-3"><i class="bi bi-chat-dots"></i> Commenti (<?php echo count($templateParams["commenti"]); ?>)</h3>
                
                <div class="list-group mb-3">
                    <?php if(count($templateParams["commenti"]) > 0): ?>
                        <?php foreach($templateParams["commenti"] as $commento): ?>
                            <div class="list-group-item border-start border-danger border-4 mb-2 shadow-sm rounded">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1 fw-bold"><?php echo htmlspecialchars($commento["usernameUtente"]); ?></h6>
                                    <small class="text-muted"><?php echo date("H:i", strtotime($commento["dataPubblicazione"])); ?></small>
                                </div>
                                <p class="mb-1 small"><?php echo htmlspecialchars($commento["testo"]); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">Ancora nessun commento. Sii il primo!</p>
                    <?php endif; ?>
                </div>

                <div class="card card-body bg-light border-0">
                    <form action="aggiungi-commento.php" method="POST">
                        <input type="hidden" name="idSpot" value="<?php echo $templateParams["spot"]["idSpot"]; ?>">
                        <div class="mb-3">
                            <label for="commento" class="visually-hidden">Scrivi un commento</label>
                            <textarea class="form-control form-control-sm" name="testo" id="commento" rows="3" placeholder="Scrivi un commento..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger btn-sm w-100">Invia</button>
                    </form>
                </div>
            </aside>
        </div>

    </div>
</section>