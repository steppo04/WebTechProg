<section class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow rounded-3 border-0">
                <div class="card-body p-5">

                    <h1 class="h2 text-center mb-4 text-dark fw-bold">Login</h1>

                    <?php if (isset($templateParams["errorelogin"])): ?>
                        <div class="alert alert-danger" role="alert" aria-live="assertive">
                            <?php echo $templateParams["errorelogin"]; ?>
                        </div>
                    <?php endif; ?>

                    <form action="login.php" method="POST">

                        <div class="mb-4">
                            <label for="username" class="form-label fw-semibold text-dark">Username</label>
                            <input type="text" id="username" name="username"
                                class="form-control form-control-lg border-secondary" required aria-required="true"
                                autocomplete="username" />
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold text-dark">Password</label>
                            <input type="password" id="password" name="password"
                                class="form-control form-control-lg border-secondary" required aria-required="true"
                                autocomplete="current-password" />
                        </div>

                        <div class="d-grid gap-2 mb-4">
                            <button class="btn btn-primary btn-lg" type="submit">Accedi</button>
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="mb-0 text-dark">
                                Non sei ancora registrato?
                                <br>
                                <a href="sign-up.php" class="link-primary fw-bold text-decoration-underline">Registrati
                                    qui</a>
                            </p>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>