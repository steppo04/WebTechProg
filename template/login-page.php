<style>
    /* Aesthetic Red Background */
    .aesthetic-wrapper {
        min-height: 100vh;
        font-family: 'Outfit', sans-serif;
        background-color: #b92b27;
        color: #333;
        overflow-x: hidden;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .aesthetic-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #a71d31 0%, #3f0d12 100%);
        z-index: -2;
    }

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

    .auth-card {
        background: #ffffff;
        border: 4px solid #1a1a1a;
        border-radius: 16px;
        padding: 3rem 2.5rem;
        width: 100%;
        max-width: 450px;
        position: relative;
        box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.2);
        z-index: 10;
        transform: rotate(-0.5deg);
    }

    .auth-title {
        font-size: 2.5rem;
        font-weight: 900;
        color: #b92b27;
        text-transform: uppercase;
        margin-bottom: 2rem;
        text-align: center;
        letter-spacing: -1px;
    }

    .form-label {
        font-weight: 700;
        color: #333;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .form-control {
        border: 2px solid #1a1a1a;
        border-radius: 8px;
        padding: 10px 15px;
        font-weight: 500;
        background-color: #f9f9f9;
        transition: all 0.2s;
    }

    .form-control:focus {
        background-color: #fff;
        border-color: #b92b27;
        box-shadow: 0 0 0 3px rgba(185, 43, 39, 0.1);
    }

    .btn-auth {
        background-color: #a71d31;
        color: white;
        border: 2px solid #a71d31;
        border-radius: 50px;
        font-weight: 700;
        padding: 12px;
        width: 100%;
        text-transform: uppercase;
        margin-top: 1rem;
        transition: all 0.2s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-auth:hover {
        background-color: #801020;
        border-color: #801020;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .auth-link {
        color: #b92b27;
        font-weight: 700;
        text-decoration: none;
        border-bottom: 2px solid transparent;
        transition: border-color 0.2s;
    }

    .auth-link:hover {
        border-color: #b92b27;
        color: #801020;
    }
</style>

<div class="aesthetic-wrapper">
    <div class="aesthetic-bg"></div>
    <div class="noise-overlay"></div>

    <div class="auth-card">
        <h1 class="auth-title">Login</h1>

        <?php if (isset($templateParams["errorelogin"])): ?>
            <div class="alert alert-danger border-2 border-danger text-center fw-bold" role="alert">
                <?php echo $templateParams["errorelogin"]; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" required
                    autocomplete="username" />
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required
                    autocomplete="current-password" />
            </div>

            <div class="d-grid mb-4">
                <button class="btn btn-auth" type="submit">Accedi</button>
            </div>

            <div class="text-center mt-4">
                <p class="mb-0 text-muted small fw-bold">
                    Non sei ancora registrato? <br>
                    <a href="sign-up.php" class="auth-link">CREA UN ACCOUNT</a>
                </p>
            </div>
        </form>
    </div>
</div>