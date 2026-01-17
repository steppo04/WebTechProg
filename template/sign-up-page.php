<section class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow rounded-3 border-0">
                <div class="card-body p-5">

                    <h1 class="h2 text-center mb-4 text-dark fw-bold">Registrazione</h1>

                    <?php if (isset($templateParams["erroresignup"])): ?>
                        <div class="alert alert-danger" role="alert" aria-live="assertive">
                            <?php echo $templateParams["erroresignup"]; ?>
                        </div>
                    <?php endif; ?>

                    <form action="utils/manageSignup.php" method="POST">

                        <div class="mb-4">
                            <label for="nome" class="form-label fw-semibold text-dark">Nome</label>
                            <input type="text" id="nome" name="nome"
                                class="form-control form-control-lg border-secondary" required aria-required="true"
                                autocomplete="given-name" />
                        </div>

                        <div class="mb-4">
                            <label for="cognome" class="form-label fw-semibold text-dark">Cognome</label>
                            <input type="text" id="cognome" name="cognome"
                                class="form-control form-control-lg border-secondary" required aria-required="true"
                                autocomplete="family-name" />
                        </div>

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
                                autocomplete="new-password" />
                        </div>

                        <div class="d-grid gap-2 mb-4">
                            <button class="btn btn-primary btn-lg" type="submit">Registrati</button>
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="mb-0 text-dark">
                                Sei già registrato?
                                <br>
                                <a href="login.php" class="link-primary fw-bold text-decoration-underline">Accedi
                                    qui</a>
                            </p>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>