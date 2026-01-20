<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-danger text-white py-3">
            <h2 class="h4 mb-0">Gestione Utenti</h2>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Username</th>
                            <th>Nome Completo</th>
                            <th>Stato</th>
                            <th class="text-end pe-4">Azione</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($templateParams["utenti"] as $utente): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <?php $imgUser = !empty($utente["fotoProfilo"]) ? "upload/" . $utente["fotoProfilo"] : "upload/default.png"; ?>
                                        <img src="<?php echo htmlspecialchars($imgUser); ?>" alt="Foto"
                                            class="rounded-circle me-2"
                                            style="width: 30px; height: 30px; object-fit: cover;">
                                        <strong><?php echo htmlspecialchars($utente["username"]); ?></strong>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($utente["nome"] . " " . $utente["cognome"]); ?></td>
                                <td>
                                    <span
                                        class="badge <?php echo $utente['stato'] == 'attivo' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo strtoupper($utente["stato"]); ?>
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <form method="POST" action="gestione-utenti.php">
                                        <input type="hidden" name="username" value="<?php echo $utente["username"]; ?>">
                                        <?php if ($utente["stato"] == "attivo"): ?>
                                            <button type="submit" name="azione" value="blocca"
                                                class="btn btn-sm btn-outline-danger">Blocca</button>
                                        <?php else: ?>
                                            <button type="submit" name="azione" value="sblocca"
                                                class="btn btn-sm btn-outline-success">Sblocca</button>
                                        <?php endif; ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>