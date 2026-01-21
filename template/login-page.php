<section>
    <div class="wrapper">
        <div class="bg"></div>
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
                        Non sei ancora registrato?
                        <a href="sign-up.php" class="auth-link">CREA UN ACCOUNT</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>