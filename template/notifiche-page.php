<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4 text-danger border-bottom border-danger pb-2">
                <i class="bi bi-bell-fill"></i> Le tue Notifiche
            </h2>
            
            <?php if(empty($templateParams["notifiche"])): ?>
                <div class="alert alert-dark text-center shadow-sm">
                    Non hai ancora ricevuto nessuna notifica.
                </div>
            <?php else: ?>
                <div class="list-group shadow-sm">
                    <?php foreach($templateParams["notifiche"] as $notifica): ?>
                        <a href="<?php echo $notifica['link']; ?>" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-start-danger">
                            <div>
                                <p class="mb-1 text-dark"><?php echo htmlspecialchars($notifica['testo']); ?></p>
                                <small class="text-danger"><i class="bi bi-arrow-right"></i> Vai allo spot</small>
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
</div>

<style>
    .border-start-danger {
        border-left: 5px solid #dc3545 !important;
    }
    .list-group-item-action:hover {
        background-color: #f8f9fa;
        transition: 0.2s;
    }
</style>