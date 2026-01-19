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

          <?php if(isUserLoggedIn()): ?>
            <li class="nav-item"><a class="nav-link" href="gestione-spot.php">Crea Spot</a></li>
            <li class="nav-item"><a class="nav-link" href="preferiti.php">I miei preferiti</a></li>
          <?php endif; ?>

          <?php if(isAdminLoggedIn()): ?>
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


  <main class="flex-shrink-0">
    <?php
    if (isset($templateParams["nome"])) {
      require($templateParams["nome"]);
    }
    ?>
  </main>

  <footer class="footer mt-auto py-3 bg-body-tertiary">
    <div class="container">
      <span class="text-body-secondary">Place sticky footer content here.</span>
    </div>
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>