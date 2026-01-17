<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-danger text-white py-3">
                    <?php 
                    $spot = isset($templateParams["spot"]) ? $templateParams["spot"] : null; 
                    $isEdit = ($spot != null);
                    ?>
                    <h2 class="h4 mb-0"><?php echo $isEdit ? "Modifica Spot" : "+ Crea il tuo Spot"; ?></h2>
                </div>
                
                <div class="card-body p-4">
                    <form action="gestione-spot.php<?php echo $isEdit ? '?id=' . $spot['idSpot'] : ''; ?>" method="POST">
                        <div class="mb-3">
                            <label for="titolo" class="form-label fw-bold">Titolo</label>
                            <input type="text" name="titolo" class="form-control" id="titolo" value="<?php echo $isEdit ? htmlspecialchars($spot['titolo']) : ''; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="categoria" class="form-label fw-bold">Categoria</label>
                            <select name="categoria" id="categoria" class="form-select" required>
                                <option value="">Seleziona...</option>
                                <?php foreach($templateParams["categorie"] as $cat): ?>
                                    <option value="<?php echo $cat['idCategoria']; ?>" <?php echo ($isEdit && $spot['idCategoria'] == $cat['idCategoria']) ? 'selected' : ''; ?>>
                                        <?php echo $cat['nome']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="testo" class="form-label fw-bold">Descrizione dello Spotted</label>
                            <textarea name="testo" class="form-control" id="testo" rows="5" required><?php echo $isEdit ? htmlspecialchars($spot['testo']) : ''; ?></textarea>
                        </div>

                        <div class="mt-4">
                            <?php if (!$isEdit): ?>
                                <button type="submit" name="azione" value="pubblica" class="btn btn-danger w-100">Pubblica</button>
                            <?php else: ?>
                                <div class="d-flex gap-2">
                                    <button type="submit" name="azione" value="modifica" class="btn btn-warning flex-grow-1">Modifica</button>
                                    <button type="submit" name="azione" value="elimina" class="btn btn-outline-danger flex-grow-1" onclick="return confirm('Vuoi eliminare definitivamente lo spot?')">Elimina</button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>