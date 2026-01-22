<section class="wrapper">
    <div class="bg" aria-hidden="true"></div>
    <div class="noise-overlay" aria-hidden="true"></div>

    <div class="auth-card">
        <h1 class="auth-title">Registrazione</h1>

        <?php if (isset($templateParams["erroresignup"])): ?>
            <div class="alert alert-danger border-2 border-danger text-center fw-bold" role="alert">
                <?php echo $templateParams["erroresignup"]; ?>
            </div>
        <?php endif; ?>

        <form action="utils/manageSignup.php" method="POST">
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" id="nome" name="nome" class="form-control" required autocomplete="given-name" />
                </div>
                <div class="col-6 mb-3">
                    <label for="cognome" class="form-label">Cognome</label>
                    <input type="text" id="cognome" name="cognome" class="form-control" required
                        autocomplete="family-name" />
                </div>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" required
                    autocomplete="username" />
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required
                    autocomplete="new-password" />
            </div>

            <div class="d-grid mb-4">
                <button class="btn btn-auth" type="submit">Registrati</button>
            </div>

            <div class="text-center mt-4">
                <p class="mb-0 small fw-bold text-dark">
                    Sei già registrato?
                    <a href="login.php" class="auth-link text-decoration-underline" style="color: #b02a37;">
                        ACCEDI QUI
                    </a>
                </p>
            </div>
        </form>
    </div>
</section>


<script src="js/signup.js"></script>