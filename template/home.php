<section class="aesthetic-wrapper">
    <div class="aesthetic-bg" aria-hidden="true"></div>
    <div class="noise-overlay" aria-hidden="true"></div>

    <div class="container">

        <div class="hanging-system">
            <div class="wire left" aria-hidden="true"></div>
            <div class="wire right" aria-hidden="true"></div>

            <div class="sign-board">


                <h1 class="title-main">SPOTTED CAMPUS</h1>
                <p class="text-desc">
                    "Il punto di riferimento per la tua vita universitaria.
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
                <div class="icon-wrapper" aria-hidden="true"><i class="bi bi-megaphone-fill" aria-hidden="true"></i></div>
                <h2 class="box-title">Racconta</h2>
                <p class="box-text">Hai visto qualcosa di interessante?Condividilo con la community in pochi click.
                </p>
            </div>

            <div class="info-box">
                <div class="icon-wrapper" aria-hidden="true"><i class="bi bi-geo-alt-fill" aria-hidden="true"></i></div>
                <h2 class="box-title">Ritrova</h2>
                <p class="box-text">Chiavi perse? Libri dimenticati?Cerca nella categoria oggetti smarriti.</p>
            </div>

            <div class="info-box">
                <div class="icon-wrapper" aria-hidden="true"><i class="bi bi-people-fill"></i></div>
                <h2 class="box-title">Connettiti</h2>
                <p class="box-text">Rispondi agli spot e interagisci con gli altri studenti del campus.</p>
            </div>

        </div>

    </div>
</section>