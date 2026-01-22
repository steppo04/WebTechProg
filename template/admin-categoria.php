<section class="container mt-5">

    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="display-6 border-bottom pb-2">Inserisci nuove categorie</h2>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow-sm border-0 border-end">

                <div class="card-header bg-danger text-white py-3 text-center">
                    <h3 class="mb-0 fw-bold">Crea Nuovo Elemento</h3>
                </div>

                <div class="card-body p-4">

                    <form action="#" method="POST">

                        <div class="mb-3">
                            <label for="nomeCategoria" class="form-label fw-bold text-secondary">Nome Categoria</label>
                            
                            <input type="text" class="form-control ps-3"
                                id="nomeCategoria"
                                name="nomeCategoria"
                                placeholder="Es. Calcio, Cucina..." required>
                        </div>

                        <div class="mb-4">
                            <label for="idCategoriaPadre" class="form-label fw-bold text-secondary">Appartiene a (Opzionale)</label>
                            
                            <select id="idCategoriaPadre" class="form-select" name="idCategoriaPadre">
                                <option value="" selected class="text-muted">-- Nessuna (Crea Categoria Principale) --</option>

                                <?php foreach ($templateParams["categoriePrincipali"] as $cat): ?>
                                    <option value="<?php echo $cat['idCategoria']; ?>">
                                        <?php echo htmlspecialchars($cat['nome']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            
                            <div class="form-text text-muted mt-2 small">
                                <i class="bi bi-info-circle-fill text-danger opacity-75"></i>
                                Seleziona un genitore per creare una <strong>Sottocategoria</strong>, altrimenti lascialo vuoto.
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-danger shadow-sm text-uppercase fw-bold py-2">
                                <i class="bi bi-plus-lg me-1"></i> Salva Categoria
                            </button>

                            <a href="index.php" class="btn btn-light text-muted border-0 btn-sm">
                                Annulla e torna alla Home
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</section>  