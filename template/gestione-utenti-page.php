<section class="container mt-5" aria-labelledby="main-title">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 id="main-title" class="border-bottom pb-2">Gestione Utenti</h1>
        </div>
    </div>

    <div class="row g-3">
        <?php foreach ($templateParams["utenti"] as $utente): ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 border-start border-danger border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <?php $imgUser = !empty($utente["fotoProfilo"]) ? "upload/" . $utente["fotoProfilo"] : "upload/default.png"; ?>
                            <img src="<?php echo htmlspecialchars($imgUser); ?>" alt="" class="rounded-circle me-3"
                                style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h2 class="h6 mb-0 fw-bold"><?php echo htmlspecialchars($utente["username"]); ?></h2>
                                <small
                                    class="text-muted"><?php echo htmlspecialchars($utente["nome"] . " " . $utente["cognome"]); ?></small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge <?php echo $utente['stato'] == 'attivo' ? 'bg-success' : 'bg-danger'; ?>">
                                <?php echo strtoupper($utente["stato"]); ?>
                            </span>

                            <form method="POST" action="gestione-utenti.php">
                                <input type="hidden" name="username" value="<?php echo $utente["username"]; ?>">
                                <?php if ($utente["stato"] == "attivo"): ?>
                                    <button type="submit" name="azione" value="blocca"
                                        class="btn btn-sm btn-outline-danger">Blocca Utente</button>
                                <?php else: ?>
                                    <button type="submit" name="azione" value="sblocca"
                                        class="btn btn-sm btn-outline-success">Sblocca Utente</button>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>