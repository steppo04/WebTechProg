  <section class="container" aria-labelledby="main-title">
      <div class="row mt-5">

          <?php if (isset($templateParams["titolo"])): ?>

              <div class="row mb-4">
                  <div class="col-12 text-center">
                      <h1 id="main-title" class="display-6"><?php echo htmlspecialchars($templateParams["titolo"]); ?></h1>
                  </div>
              </div>
          <?php endif; ?>

          <div class="row mb-3 border-top pt-3">
              <div class="col-12 d-flex justify-content-start">
                  <div class="dropdown">
                      <button class="btn btn-light dropdown-toggle btn-sm" type="button" id="dropdownSort" data-bs-toggle="dropdown" aria-expanded="false">
                          <span class="bi bi-filter-left" aria-hidden="true"></span> Ordina per
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownSort">
                          <li><a class="dropdown-item" href="preferiti.php?filter=newest">Più recenti</a></li>
                          <li><a class="dropdown-item" href="preferiti.php?filter=oldest">Meno recenti</a></li>
                          <li><a class="dropdown-item" href="preferiti.php?filter=az">Titolo (A-Z)</a></li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>

      <div class="row g-4 mt-1">

          <?php if (count($templateParams["spot"]) > 0): ?>
              <?php foreach ($templateParams["spot"] as $spot): ?>

                  <div class="col-12 col-md-6 col-lg-4">
                      <article class="card h-100 shadow-sm card-spot">
                          <div class="card-header bg-danger text-white">
                              <h2 class="card-title mb-0 fs-5"><?php echo htmlspecialchars($spot["titolo"]); ?></h2>
                          </div>
                          <div class="card-body">
                              <p class="card-text text-muted small">
                                  <span class="bi bi-chat-left-text" aria-hidden="true"></span> Spot:
                              </p>
                              <p class="card-text"><?php echo htmlspecialchars($spot["testo"]); ?></p>
                          </div>
                          <div class="card-footer bg-transparent border-top-0">
                              <a href="dettaglio-spot.php?id=<?php echo $spot['idSpot']; ?>" class="btn btn-outline-danger btn-sm" aria-label="Leggi di più sullo spot: <?php echo htmlspecialchars($spot['titolo']); ?>">
                                  Leggi di più
                              </a>
                          </div>
                      </article>
                  </div>

              <?php endforeach; ?>
          <?php else: ?>

              <div class="col-12 text-center my-5">
                  <p class="lead">Nessuno spot trovato.</p>
                  <a href="lista-categoria.php" class="btn btn-secondary">Salva degli spot!</a>
              </div>

          <?php endif; ?>
      </div>
  </section>