<section class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4 text-danger border-bottom border-danger pb-2">
                <i class="bi bi-bell-fill"></i> Nuove Notifiche
            </h2>

            <?php
            $nuoveNotifiche = array_filter($templateParams["notifiche"], function ($n) {
                return $n["letta"] == 0;
            });
            ?>

            <?php if (empty($nuoveNotifiche)): ?>
                <div class="alert alert-light text-center shadow-sm mb-5">
                    Non ci sono nuove notifiche.
                </div>
            <?php else: ?>
                <div class="list-group shadow-sm mb-5">
                    <?php foreach ($nuoveNotifiche as $notifica): ?>
                        <a href="<?php echo $notifica['link']; ?>"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-start-danger">
                            <div>
                                <p class="mb-1 fw-bold text-dark"><?php echo htmlspecialchars($notifica['testo']); ?></p>
                                <small class="text-danger"><i class="bi bi-arrow-right"></i> Vai allo spot</small>
                            </div>
                            <span class="badge bg-danger rounded-pill">Nuova</span>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <h2 class="mb-4 text-danger border-bottom border-secondary pb-2 mt-5">
                <i class="bi bi-archive-fill"></i> Tutte le Notifiche
            </h2>

            <?php if (empty($templateParams["notifiche"])): ?>
                <div class="alert alert-dark text-center shadow-sm">
                    Storico notifiche vuoto.
                </div>
            <?php else: ?>
                <div class="list-group shadow-sm opacity-75">
                    <?php foreach ($templateParams["notifiche"] as $notifica): ?>
                        <a href="<?php echo $notifica['link']; ?>"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 text-muted"><?php echo htmlspecialchars($notifica['testo']); ?></p>
                            </div>
                            <span class="badge bg-secondary rounded-pill">
                                <?php echo date("d/m H:i", strtotime($notifica['dataNotifica'])); ?>
                            </span>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>