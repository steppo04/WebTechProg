<!DOCTYPE html>
<html lang="it" class="h-100">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $templateParams["titolo"]; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./css/style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body class="d-flex flex-column h-100">

  <header>
  </header>

  <nav
    class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm py-3 border-bottom border-4 border-danger">
    <div class="container-fluid px-4">
      <a class="navbar-brand text-danger fw-bold fs-4" href="index.php">Spotted Campus</a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-dark fw-bold hover-danger hover-underline" href="lista-categoria.php">Lista
              Spotted</a>
          </li>

          <?php if (isUserLoggedIn()): ?>
            <li class="nav-item">
              <a class="nav-link text-dark fw-bold hover-danger hover-underline" href="gestione-spot.php">Crea Spot</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark fw-bold hover-danger hover-underline" href="preferiti.php">I miei preferiti</a>
            </li>
          <?php endif; ?>

          <?php if (isAdminLoggedIn()): ?>
            <li class="nav-item">
              <a class="nav-link text-dark fw-bold hover-danger hover-underline" href="revisione.php">Revisione Spot</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark fw-bold hover-danger hover-underline" href="gestione-utenti.php">Gestione
                Utenti</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark fw-bold hover-danger hover-underline" href="admin-stats.php">Statistiche</a>
            </li>
          <?php endif; ?>
              <li class="nav-item">
                  <a class="nav-link text-dark fw-bold hover-danger hover-underline" href="chi-siamo.php">Chi Siamo</a>
              </li>
        </ul>

        <div class="d-flex align-items-center gap-3">
        <?php if (!isUserLoggedIn() && !isAdminLoggedIn()): ?>
          <a href="login.php" class="btn btn-danger text-white rounded-pill px-4 fw-bold shadow-sm">Accedi</a>
            <?php else: ?>
              <span class="text-secondary fw-medium me-2 d-none d-lg-block">Ciao, 
                <span class="text-dark fw-bold"><?php echo $_SESSION["username"]; ?></span>
              </span>
    
              <?php if (isUserLoggedIn()): 
                $unreadCount = $dbh->getUnreadNotificationsCount($_SESSION["username"]); 
              ?>
              <a href="notifiche.php" class="btn btn-link text-danger me-3 position-relative py-1 px-2 text-decoration-none">
                  <i class="bi bi-bell-fill" style="font-size: 1.2rem;"></i>
                  <?php if ($unreadCount > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.7rem;">
                      <?php echo $unreadCount; ?>
                        <span class="visually-hidden">notifiche non lette</span>
                      </span>
                    <?php endif; ?>
              </a>
              <?php endif; ?>

            <a href="profilo.php" class="btn btn-outline-danger rounded-pill px-3 fw-bold btn-sm">Profilo</a>
            <a href="logout.php" class="btn btn-link text-danger text-decoration-none fw-bold small">Esci</a>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>


  <main class="flex-shrink-0 pb-5">
    <?php
    if (isset($templateParams["nome"])) {
      require($templateParams["nome"]);
    }
    ?>
  </main>

  <footer class="bg-white text-dark py-3 mt-auto mt-5 border-top border-4 border-danger shadow-sm">
    <div class="container">
      <div class="row align-items-center">

        <div class="col-md-3 text-center text-md-start">
          <span class="d-block fw-bold text-danger">Spotted Campus</span>
          <small class="text-muted" style="font-size: 0.75rem;">&copy; <?php echo date("Y"); ?> All rights
            reserved.</small>
        </div>

        <div class="col-md-6 text-center my-2 my-md-0">
          <a href="chi-siamo.php" class="text-dark text-decoration-none fw-bold px-2 small">Chi Siamo</a>
          <a href="lista-categoria.php" class="text-dark text-decoration-none fw-bold px-2 small">Lista Spotted</a>
          <a href="mailto:spottedcampus@unibo.com"
            class="text-dark text-decoration-none fw-bold px-2 small">Contattaci</a>
          <a href="https://maps.app.goo.gl/dLQ2NFKTWv7YAmEy9"
            class="text-dark text-decoration-none fw-bold px-2 small">Dove siamo</a>
        </div>

        <div class="col-md-3 text-center text-md-end">
          <span class="d-block fw-bold small mb-1">Social</span>
          <div>
            <a href="#" class="text-dark me-2 fs-5"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-dark me-2 fs-5"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-dark fs-5"><i class="bi bi-tiktok"></i></a>
          </div>
        </div>

      </div>
    </div>
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>