<?php if(isset($templateParams["titolo_pagina"])): ?>
        <h2><?php echo $templateParams["titolo_pagina"]; ?></h2>
        <?php endif;?>
        <?php foreach($templateParams["spotcasuali"] as $spot): ?>
        <div class="container">
            <div class="row">
                <div class="col-6 bg-danger">
                    <p><?php echo $spot["titolo"]?></p>
                </div>
                <div class="col-6 bg-success">
                    <p><?php echo $spot["testo"]?></p>
                </div>
            </div>
        </div>
<?php endforeach; ?>