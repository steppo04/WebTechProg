<div class="container mt-5">
    <h2 class="mb-4 text-center">Gestione Utenti</h2>
    
    <div class="table-responsive bg-light p-3 rounded shadow-sm">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Username</th>
                    <th>Nome Completo</th>
                    <th>Stato</th>
                    <th class="text-center">Azione</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($templateParams["utenti"] as $utente): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($utente["username"]); ?></strong></td>
                    <td><?php echo htmlspecialchars($utente["nome"] . " " . $utente["cognome"]); ?></td>
                    <td>
                        <span class="badge <?php echo $utente['stato'] == 'attivo' ? 'bg-success' : 'bg-danger'; ?>">
                            <?php echo strtoupper($utente["stato"]); ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <form method="POST" action="gestione-utenti.php">
                            <input type="hidden" name="username" value="<?php echo $utente["username"]; ?>">
                            <?php if($utente["stato"] == "attivo"): ?>
                                <button type="submit" name="azione" value="blocca" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-slash-circle"></i> Blocca
                                </button>
                            <?php else: ?>
                                <button type="submit" name="azione" value="sblocca" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-check-circle"></i> Sblocca
                                </button>
                            <?php endif; ?>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>