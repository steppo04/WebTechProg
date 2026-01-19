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

  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Fixed navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="lista-categoria.php">Lista Spotted</a></li>

          <?php if (isUserLoggedIn()): ?>
            <li class="nav-item"><a class="nav-link" href="gestione-spot.php">Crea Spot</a></li>
            <li class="nav-item"><a class="nav-link" href="preferiti.php">I miei preferiti</a></li>
          <?php endif; ?>

          <?php if (isAdminLoggedIn()): ?>
            <li class="nav-item">
              <a class="nav-link text-danger" href="revisione.php">Revisione Spot</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger" href="gestione-utenti.php">Gestione Utenti</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger" href="admin-stats.php">Statistiche</a>
            </li>
          <?php endif; ?>
              <li class="nav-item">
                  <a class="nav-link <?php isActive('chi-siamo.php'); ?>" href="chi-siamo.php">Chi Siamo</a>
              </li>
        </ul>

        <?php if (!isUserLoggedIn() && !isAdminLoggedIn()): ?>
          <a href="login.php" class="btn btn-outline-light me-2">Accedi</a>
        <?php else: ?>
          <span class="text-light me-2">Benvenuto, <?php echo $_SESSION["username"]; ?></span>
          <a href="profilo.php" class="btn btn-outline-info me-2">Profilo</a>
          <a href="logout.php" class="btn btn-outline-danger me-2">Esci</a>
        <?php endif; ?>

        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
          <button class="btn btn-outline-success" type="submit">
            Search
          </button>
        </form>
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