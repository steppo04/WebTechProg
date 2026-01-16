<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title> 
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    
    <header>
        <h1>spotted bro</h1>
    </header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    <main>
        
    </main><aside>
        <section>
           <?php require_once 'bootstrap.php';
                $var = $dbh->getUsers();
                foreach($var as $array){
                    echo $array["Username"];
                }
                //echo $var[0]['Username'];
           ?>
        </section>
        <section>
            
        </section>
    </aside>

<footer class="text-center text-lg-start text-white mt-auto" style="background-color: #929fba">

    <div class="container p-4">

        <div class="row">

            <div class="col-md-4 mx-auto mb-3">
                <h6 class="text-uppercase fw-bold">Company</h6>
                <p>Descrizione azienda.</p>
            </div>

            <div class="col-md-4 mx-auto mb-3">
                <h6 class="text-uppercase fw-bold">Contatti</h6>
                <p><i class="fas fa-envelope me-2"></i> info@email.com</p>
                <p><i class="fas fa-phone me-2"></i> +39 123 456 789</p>
            </div>

            <div class="col-md-4 mx-auto mb-3">
                <h6 class="text-uppercase fw-bold">Social</h6>
                <a class="btn btn-dark btn-sm me-1" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark btn-sm me-1" href="#"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-dark btn-sm" href="#"><i class="fab fa-github"></i></a>
            </div>

        </div>

    </div>

    <div class="text-center p-2 bg-dark">
        © 2026 MySite
    </div>

</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>


</html>