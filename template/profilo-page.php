<section class="container mt-5">
    <div class="row mb-5 justify-content-center">
        <div class="col-md-8 text-center">
            <div class="p-4 bg-light rounded shadow-sm border-top border-danger border-4">
                <?php
                $imgProfile = !empty($templateParams["utente"]["fotoProfilo"]) ? "upload/" . $templateParams["utente"]["fotoProfilo"] : "upload/default.png";
                ?>
                <img src="<?php echo htmlspecialchars($imgProfile); ?>" alt="Foto profilo di <?php echo htmlspecialchars($templateParams["utente"]["username"]); ?>" class="profile-img mb-3">

                <h2 class="mt-2 text-wrap text-break">
                    <?php echo htmlspecialchars($templateParams["utente"]["nome"] . " " . htmlspecialchars($templateParams["utente"]["cognome"])); ?>
                </h2>
                <p class="text-muted">@<?php echo htmlspecialchars($templateParams["utente"]["username"]); ?></p>

                <?php if ($templateParams["isMine"]): ?>
                    <form action="upload-profile-pic.php" method="post" enctype="multipart/form-data" id="profileForm" class="mb-3">

                        <label for="fileToUpload" class="visually-hidden">Carica una nuova foto profilo</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" class="d-none" accept="image/x-png,image/gif,image/jpeg">

                        <button type="button" class="btn btn-outline-danger btn-sm" id="btnChangePhoto">
                            <span class="bi bi-pencil-square me-1" aria-hidden="true"></span> Modifica Foto
                        </button>
                    </form>

                    <script src="js/profilo.js"></script>

                <?php endif; ?>

                <?php if ($templateParams["isAdminProfile"]): ?>
                    <span class="badge bg-danger mb-3">AMMINISTRATORE</span>
                <?php endif; ?>

                <?php if ($templateParams["isMine"]): ?>
                    <div class="mt-2">
                        <a href="logout.php" class="btn btn-outline-danger btn-sm">Disconnetti</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (!$templateParams["isAdminProfile"]): ?>
        <div class="row g-4">
            <div class="col-12 mb-3">
                <h3 class="border-bottom pb-2">I miei Spotted</h3>
            </div>
        </div>

        <?php if (count($templateParams["spots"]) > 0): ?>
            <div class="row g-4">
                <?php foreach ($templateParams["spots"] as $spot): ?>
                    <div class="col-md-6 col-lg-4">
                        <article class="card h-100 shadow-sm">
                            <div class="card-header bg-danger text-white">
                                <span><?php echo htmlspecialchars($spot["nomeCategoria"]); ?></span>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title"><?php echo htmlspecialchars($spot["titolo"]); ?></h3>
                                <p class="card-text text-truncate"><?php echo htmlspecialchars($spot["testo"]); ?></p>
                                <div class="d-flex justify-content-between mt-3">
                                    <a href="dettaglio-spot.php?id=<?php echo $spot["idSpot"]; ?>"
                                        class="btn btn-sm btn-outline-danger"
                                        aria-label="Leggi lo spot: <?php echo htmlspecialchars($spot["titolo"]); ?>">Leggi</a>

                                    <?php if ($templateParams["isMine"]): ?>
                                        <span class="badge bg-secondary"><?php echo strtoupper($spot["stato"]); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center mt-4">
                <p class="text-muted">Nessuno spot pubblicato.</p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</section>