<section class="container mt-5" aria-labelledby="titolo-statistiche">

    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 id="titolo-statistiche" class="display-6 border-bottom pb-2">Pannello Statistiche</h2>
        </div>
    </div>

    <div class="row g-4 mb-5 text-center">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Spot Approvati</p>
                    <h3 class="display-4 text-danger fw-bold">
                        <?php echo htmlspecialchars($templateParams["stats"]['approvati']); ?>
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">In Attesa di Revisione</p>
                    <h3 class="display-4 text-warning fw-bold">
                        <?php echo htmlspecialchars($templateParams["stats"]['in_attesa']); ?>
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Utenti Attivi</p>
                    <h3 class="display-4 text-success fw-bold">
                        <?php echo htmlspecialchars($templateParams["stats"]['utenti_attivi']); ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-danger text-white">
                    <h4 class="h5 mb-0">
                        <span class="bi bi-star-fill" aria-hidden="true"></span> 
                        Fan più attivo
                    </h4>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                    <span class="h4 mb-0">
                        <?php echo htmlspecialchars($templateParams["top_user"]['usernameUtente'] ?? 'Nessuno'); ?>
                    </span>
                    <span class="badge bg-danger p-2 px-3">
                        <?php echo htmlspecialchars($templateParams["top_user"]['total'] ?? 0); ?> Spot
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-danger text-white">
                    <h4 class="h5 mb-0">
                        <span class="bi bi-tag-fill" aria-hidden="true"></span> 
                        Categoria Popolare
                    </h4>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                    <span class="h4 mb-0">
                        <?php echo htmlspecialchars($templateParams["top_cat"]['nome'] ?? 'Nessuna'); ?>
                    </span>
                    <span class="badge bg-dark p-2 px-3">
                        <?php echo htmlspecialchars($templateParams["top_cat"]['total'] ?? 0); ?> Post
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>