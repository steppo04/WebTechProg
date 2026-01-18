<style>
    /* --- 1. SFONDO AESTHETIC (Noise + Gradiente) --- */
    .aesthetic-wrapper {
        min-height: 100vh;
        font-family: 'Outfit', sans-serif;
        background-color: #b92b27;
        color: #333;
        overflow-x: hidden;
        position: relative;
    }

    .aesthetic-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /* Gradiente rosso intenso */
        background: linear-gradient(135deg, #a71d31 0%, #3f0d12 100%);
        z-index: -2;
    }

    /* Effetto "Grana" (Noise) per renderlo premium */
    .noise-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.05;
        background: url('https://grainy-gradients.vercel.app/noise.svg');
        pointer-events: none;
        z-index: -1;
    }

    /* --- 3. IL CARTELLO (Geometrico & Pulito) --- */
    .hanging-system {
        position: relative;
        width: 100%;
        max-width: 650px;
        margin: 60px auto 40px;
        /* Animazione delicata di galleggiamento verticale */
        animation: float 4s ease-in-out infinite alternate;
    }

    /* I cavi di sospensione (DRITTI) */
    .wire {
        position: absolute;
        top: -100px;
        width: 4px;
        height: 100px;
        background-color: #1a1a1a;
        /* Nero opaco */
        z-index: 1;
    }

    .wire.left {
        left: 18%;
    }

    .wire.right {
        right: 23%;
    }

    /* Il Cartello */
    .sign-board {
        position: relative;
        background: #ffffff;
        /* BORDO SPESSO E DEFINITO */
        border: 4px solid #1a1a1a;
        border-radius: 16px;
        padding: 3rem 2rem;
        text-align: center;
        /* Ombra dura per staccarlo dallo sfondo */
        box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.2);
        transform: rotate(-1deg);
        /* Leggerissima inclinazione estetica fissa */
    }

    /* Le clip che reggono il cartello */
    .clip {
        width: 20px;
        height: 30px;
        background: #333;
        border-radius: 4px;
        position: absolute;
        top: -15px;
        z-index: 2;
    }

    .clip.left {
        left: calc(18% - 8px);
    }

    .clip.right {
        right: calc(23% - 13px);
    }

    /* Testi del Cartello */
    .title-main {
        font-size: 3rem;
        font-weight: 900;
        color: #b92b27;
        /* Rosso Brand */
        text-transform: uppercase;
        letter-spacing: -1px;
        margin-bottom: 1rem;
    }

    .text-desc {
        font-size: 1.1rem;
        color: #555;
        font-style: italic;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    /* Pulsanti (Stile pillola come nella foto ma moderni) */
    .btn-custom {
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 700;
        transition: transform 0.2s, box-shadow 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    /* Bottone 1: Scopri (Rosso Scuro) */
    .btn-scopri {
        background-color: #a71d31;
        color: white;
        border: 2px solid #a71d31;
    }

    .btn-scopri:hover {
        background-color: #801020;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Bottone 2: Crea (Rosso Acceso / Outline) */
    .btn-crea {
        background-color: #d63031;
        color: white;
        border: 2px solid #d63031;
    }

    .btn-crea:hover {
        background-color: #ff4757;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Bottone Accedi (Variante per coerenza) */
    .btn-accedi {
        background-color: transparent;
        color: #d63031;
        border: 2px solid #d63031;
    }

    .btn-accedi:hover {
        background-color: #d63031;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }


    /* --- 4. LE CARD SOTTOSTANTI --- */
    .card-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
        padding-bottom: 50px;
    }

    .info-box {
        background: white;
        border: 3px solid #1a1a1a;
        /* Bordo coerente col cartello */
        border-radius: 12px;
        padding: 2rem 1.5rem;
        width: 300px;
        text-align: center;
        box-shadow: 5px 5px 0px rgba(0, 0, 0, 0.15);
        /* Ombra solida */
        transition: all 0.3s ease;
    }

    .info-box:hover {
        transform: translate(-3px, -3px);
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.2);
    }

    .icon-wrapper {
        font-size: 2.5rem;
        color: #d63031;
        margin-bottom: 1rem;
        background: #fff0f0;
        width: 70px;
        height: 70px;
        line-height: 70px;
        border-radius: 50%;
        margin-left: auto;
        margin-right: auto;
    }

    .box-title {
        font-weight: 800;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    .box-text {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.5;
    }

    /* Animazione galleggiamento */
    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        100% {
            transform: translateY(10px);
        }
    }
</style>

<div class="aesthetic-wrapper">
    <div class="aesthetic-bg"></div>
    <div class="noise-overlay"></div>

    <div class="container">

        <div class="hanging-system">
            <div class="wire left"></div>
            <div class="wire right"></div>

            <div class="sign-board">
                <div class="clip left"></div>
                <div class="clip right"></div>

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