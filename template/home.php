
<div class="aesthetic-wrapper">
    <div class="aesthetic-bg"></div>
    <div class="noise-overlay"></div>

    <div class="container">

        <div class="hanging-system">
            <div class="wire left"></div>
            <div class="wire right"></div>

            <div class="sign-board">


                <h1 class="title-main">SPOTTED CAMPUS</h1>
                <p class="text-desc">
                    "Il punto di riferimento per la tua vita universitaria.<br>
                    Ritrova oggetti smarriti, scopri info utili e condividi le tue esperienze."
                </p>

                <div class="d-flex justify-content-center gap-3">
                    <a href="lista-categoria.php" class="btn-custom btn-scopri">Scopri gli Spot</a>

                    <?php if (!isUserLoggedIn() && !isAdminLoggedIn()): ?>
                        <a href="login.php" class="btn-custom btn-accedi">Accedi</a>
                    <?php elseif (isUserLoggedIn()): ?>
                        <a href="gestione-spot.php" class="btn-custom btn-crea">+ Crea Spot</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card-container">

            <div class="info-box">
                <div class="icon-wrapper"><i class="bi bi-megaphone-fill"></i></div>
                <h3 class="box-title">Racconta</h3>
                <p class="box-text">Hai visto qualcosa di interessante? <br>Condividilo con la community in pochi click.
                </p>
            </div>

            <div class="info-box">
                <div class="icon-wrapper"><i class="bi bi-geo-alt-fill"></i></div>
                <h3 class="box-title">Ritrova</h3>
                <p class="box-text">Chiavi perse? Libri dimenticati? <br>Cerca nella categoria oggetti smarriti.</p>
            </div>

            <div class="info-box">
                <div class="icon-wrapper"><i class="bi bi-people-fill"></i></div>
                <h3 class="box-title">Connettiti</h3>
                <p class="box-text">Rispondi agli spot e interagisci con gli altri studenti del campus.</p>
            </div>

        </div>

    </div>
</div>