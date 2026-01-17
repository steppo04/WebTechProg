<div class="container mt-5">
    <?php 
    $spot = isset($templateParams["spot"]) ? $templateParams["spot"] : null; 
    $isEdit = ($spot != null);
    ?>
    <h2 class="mb-4"><?php echo $isEdit ? "Modifica Spot" : "+ Crea il tuo Spot"; ?></h2>

    <form action="gestione-spot.php<?php echo $isEdit ? '?id=' . $spot['idSpot'] : ''; ?>" method="POST" class="bg-light p-4 rounded shadow-sm">
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
            <label for="sottocategoria" class="form-label fw-bold">Sottocategoria (Opzionale)</label>
            <select name="sottocategoria" id="sottocategoria" class="form-select">
                <option value="">Nessuna</option>
                <?php foreach($templateParams["sottocategorie"] as $sub): ?>
                    <option value="<?php echo $sub['idSottoCategoria']; ?>" <?php echo ($isEdit && $spot['idSottoCategoria'] == $sub['idSottoCategoria']) ? 'selected' : ''; ?>>
                        <?php echo $sub['nome']; ?>
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
                <button type="submit" name="azione" value="pubblica" class="btn btn-primary w-100">Pubblica</button>
            <?php else: ?>
                <div class="d-flex gap-2">
                    <button type="submit" name="azione" value="modifica" class="btn btn-warning flex-grow-1">Modifica</button>
                    <button type="submit" name="azione" value="elimina" class="btn btn-danger flex-grow-1" onclick="return confirm('Vuoi eliminare definitivamente lo spot?')">Elimina</button>
                </div>
                <p class="mt-3 text-muted small text-center">* Una volta modificato, lo spot dovrà essere approvato di nuovo.</p>
            <?php endif; ?>
        </div>
    </form>
</div>