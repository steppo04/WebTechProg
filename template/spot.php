<div class="container mt-5">
    <div class="row">

        <div class="col-md-8">
            <article class="card shadow-sm mb-4">

                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <h2 class="h4 mb-0"><?php echo htmlspecialchars($templateParams["spot"]["titolo"]); ?></h2>

                    <?php
                    $iconaClass = $templateParams["isPreferito"] ? "bi-bookmark-fill" : "bi-bookmark";
                    ?>

                    <?php if (isUserLoggedIn()): ?>
                        <button type="button" class="btn btn-link text-white p-0 btn-toggle-preferito"
                            data-id="<?php echo $templateParams['spot']['idSpot']; ?>" title="Salva nei preferiti">
                            <i class="bi <?php echo $iconaClass; ?> fs-3"></i>
                        </button>
                    <?php else: ?>
                        <a href="login.php" class="text-white" title="Accedi per salvare">
                            <i class="bi bi-bookmark fs-3"></i>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="card-body">
                    <p class="lead border-bottom pb-3">
                        <?php echo htmlspecialchars($templateParams["spot"]["testo"]); ?>
                    </p>

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <h2 class="h6 text-muted small fw-bold">Dettagli Pubblicazione</h2>
                            <ul class="list-unstyled">
                                <li class="d-flex align-items-center mb-2">
                                    <strong>Autore:</strong>
                                    <?php
                                    if ($templateParams["spot"]["isAnonymous"]) {
                                        echo '<span class="fst-italic text-secondary">Anonimo <i class="bi bi-incognito"></i></span>';
                                    } else {
                                        echo htmlspecialchars($templateParams["spot"]["nomeAutore"] . " " . $templateParams["spot"]["cognomeAutore"]);
                                    }
                                    ?>
                                </li>
                                <li><strong>Data:</strong>
                                    <?php echo date("d/m/Y H:i", strtotime($templateParams["spot"]["dataInserimento"])); ?>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <h2 class="h6 text-muted small fw-bold">Classificazione</h2>
                            <ul class="list-unstyled">
                                <li><strong>Categoria:</strong> <span
                                        class="badge bg-secondary"><?php echo htmlspecialchars($templateParams["spot"]["nomeCategoria"]); ?></span>
                                </li>
                                <li><strong>Sottocategoria:</strong>
                                    <?php echo htmlspecialchars($templateParams["spot"]["nomeSottoCategoria"] ?? 'Nessuna'); ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">
                    <a href="lista-categoria.php" class="btn btn-outline-secondary btn-sm">Torna alla lista</a>

                    <?php if (isUserLoggedIn() && $_SESSION["username"] == $templateParams["spot"]["usernameUtente"]): ?>
                        <a href="gestione-spot.php?id=<?php echo $templateParams["spot"]["idSpot"]; ?>"
                            class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Modifica / Elimina
                        </a>
                    <?php endif; ?>
                </div>
            </article>
        </div>

        <div class="col-md-4 border-start">
            <aside>
                <h3 class="h5 mb-3"><i class="bi bi-chat-dots"></i> Commenti
                    (<?php echo count($templateParams["commenti"]); ?>)</h3>

                <div id="containerCommenti" class="list-group mb-3 overflow-auto" style="max-height: 35vh;">
                    <?php if (count($templateParams["commenti"]) > 0): ?>
                        <?php foreach ($templateParams["commenti"] as $commento): ?>
                            <div class="list-group-item border-start border-danger border-4 mb-2 shadow-sm rounded">

                                <?php if (!empty($commento["idCommentoRisposto"])): ?>
                                    <div class="bg-light border-start border-secondary border-2 p-1 mb-2 rounded shadow-sm"
                                        style="font-size: 0.75rem; opacity: 0.8;">
                                        <span class="text fw-bold">
                                            <i class="bi bi-quote"></i> In risposta a
                                            <?php echo htmlspecialchars($commento["autorePadre"] ?? 'utente'); ?>:
                                        </span>
                                        <p class="mb-0 text-truncate italic">
                                            "<?php echo htmlspecialchars($commento["testoPadre"] ?? 'messaggio rimosso'); ?>"
                                        </p>
                                    </div>
                                <?php endif; ?>

                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex align-items-center">
                                        <?php $imgCommento = !empty($commento["fotoProfilo"]) ? "upload/" . $commento["fotoProfilo"] : "upload/default.png"; ?>
                                        <img src="<?php echo htmlspecialchars($imgCommento); ?>" alt="Foto Profilo Utente"
                                            class="rounded-circle me-2" style="width: 30px; height: 30px; object-fit: cover;">
                                        <h4 class="mb-0 fw-bold fs-6">
                                            <?php echo htmlspecialchars($commento["usernameUtente"]); ?>
                                        </h4>
                                    </div>
                                    <small
                                        class="text-muted"><?php echo date("d/m H:i", strtotime($commento['dataPubblicazione'])); ?></small>
                                </div>

                                <p class="mb-1 small"><?php echo htmlspecialchars($commento["testo"]); ?></p>

                                <div class="text-end">
                                    <a href="?id=<?php echo $templateParams['spot']['idSpot']; ?>&rspTo=<?php echo $commento['idCommento']; ?>#formCommento"
                                        class="text-decoration-none  fw-bold text-danger">
                                        <i class="bi bi-reply"></i> Rispondi
                                    </a>

                                    <?php if (isAdminLoggedIn()): ?>
                                        <form action="elimina-commento.php" method="POST" style="display:inline;">

                                            <input type="hidden" name="id" value="<?php echo $commento['idCommento']; ?>">
                                            <input type="hidden" name="idSpot"
                                                value="<?php echo $templateParams['spot']['idSpot']; ?>">

                                            <button type="submit" class="btn btn-link text-decoration-none small fw-bold text-danger btn-confirm-delete" data-confirm-msg="Sei sicuro di voler eliminare questo commento?">
                                                <i class="bi bi-trash"></i> Elimina
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">Ancora nessun commento. Sii il primo!</p>
                    <?php endif; ?>
                </div>

                <div class="card card-body bg-light border-0">
                    <?php if (isset($_GET["rspTo"])):
                        $commentoDaRispondere = $templateParams["rispostaAPadre"];
                        ?>
                        <div
                            id="alertRisposta" class="alert alert-white border-start border-danger border-4 shadow-sm mb-3 py-2 position-relative">
                            <button type="button" class="btn-close position-absolute top-0 end-0 p-2"
                                style="font-size: 0.6rem;"
                                onclick="window.location.href='dettaglio-spot.php?id=<?php echo $templateParams['spot']['idSpot']; ?>'"></button>

                            <small class="text-danger fw-bold d-block mb-1" style="font-size: 0.7rem;">
                                <i class="bi bi-reply-fill"></i> Stai rispondendo a
                                <?php echo htmlspecialchars($commentoDaRispondere["usernameUtente"]); ?>:
                            </small>
                            <p class="mb-0 text-muted small text-truncate">
                                "<?php echo htmlspecialchars($commentoDaRispondere["testo"]); ?>"
                            </p>
                        </div>
                    <?php endif; ?>

                    <div id="alertMessageContainer"
                        class="alert alert-dismissible fade show d-none shadow-sm"
                        role="alert">

                        <i id="alertIcon" class="bi me-2"></i>

                        <span id="alertText"></span>

                        <button type="button" class="btn-close" onclick="chiudiAlert()" aria-label="Close"></button>
                    </div>

                    <form id="formCommento" action="aggiungi-commento.php" method="POST">
                        <input type="hidden" name="idSpot" value="<?php echo $templateParams["spot"]["idSpot"]; ?>">

                        <input type="hidden" name="idCommentoRisposto" value="<?php echo $_GET["rspTo"] ?? ''; ?>">

                        <div class="mb-3">
                            <label for="commento" class="visually-hidden">Scrivi un commento</label>
                            <textarea class="form-control form-control-sm" name="testo" id="commento" rows="3"
                                placeholder="Scrivi un commento..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger btn-sm w-100">
                            Invia Commento
                        </button>
                    </form>
                </div>
            </aside>
        </div>

    </div>
</div>

<script src="js/commenti.js"></script>