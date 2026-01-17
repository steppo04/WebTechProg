<!DOCTYPE html>
<html lang="it" class="h-100">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title> 
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="d-flex flex-column h-100">

    <header>
        <h1>spotted bro</h1>
    </header>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Fixed navbar</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
              <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-outline-success" type="submit">
                Search
              </button>
            </form>
          </div>
        </div>
    </nav>


    <main class="flex-shrink-0">
        <div class="container">
        <h1 class="mt-5">Sticky footer</h1>
        <p class="lead">
          Pin a footer to the bottom of the viewport in desktop browsers with
          this custom HTML and CSS.
        </p>
        <p>
          Use
          <a href="../examples/sticky-footer-navbar/"
            >the sticky footer with a fixed navbar</a
          >
          if need be, too.
        </p>
      </div>
       <aside>
        <section>
           <?php require_once 'bootstrap.php';
                $var = $dbh->getUsers();
                foreach($var as $array){
                    echo $array["username"];
                }
                //echo $var[0]['Username'];
           ?>
        </section>
        <section>
            
        </section>
    </aside>
    </main>
    
    <footer class="footer mt-auto py-3 bg-body-tertiary">
      <div class="container">
        <span class="text-body-secondary"
          >Place sticky footer content here.</span
        >
      </div>
    </footer>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>