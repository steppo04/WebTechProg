<section class="container mt-5">

    <?php if (isset($templateParams["titolo"])): ?>
        <div class="row mb-4 border-bottom pb-4">
            <div class="col-12 text-center">
                <h1 class="display-6"><?php echo $templateParams["titolo"]; ?></h1>
            </div>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <form action="lista-categoria.php" method="GET" id="form-ricerca">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-8">
                        <div class="d-flex gap-2" role="search">
                            <label for="ricerca" class="visually-hidden">Ricerca</label>
                            <input type="text" class="form-control form-control-lg" name="ricerca" id="ricerca"
                                placeholder="Cerca uno spot..."
                                value="<?php echo isset($_GET['ricerca']) ? htmlspecialchars($_GET['ricerca']) : ''; ?>">

                            <button type="submit" class="btn btn-danger">Cerca</button>

                            <button type="button" class="btn btn-outline-dark d-flex gap-2 align-items-center" data-bs-toggle="modal" data-bs-target="#modalFiltri">
                                <i class="bi bi-funnel"></i> Filtri
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="modal fade" id="modalFiltri" tabindex="-1" role="dialog" aria-labelledby="modalFiltriLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title fs-5" id="modalFiltriLabel">Filtra per Categoria</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Seleziona una o più categorie:</p>
                            <?php foreach ($templateParams["categorie"] as $categoria): ?>
                                <div class="form-check mb-2">
                                    <input class="form-check-input check-filtro" type="checkbox" name="cat[]"
                                        value="<?php echo $categoria['idCategoria']; ?>"
                                        id="cat<?php echo $categoria['idCategoria']; ?>"
                                        <?php if (isset($_GET["cat"]) && in_array($categoria['idCategoria'], $_GET["cat"])) echo "checked"; ?>>
                                    <label class="form-check-label" for="cat<?php echo $categoria['idCategoria']; ?>">
                                        <?php echo $categoria['nome']; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4" id="container-spot">
        <?php if (count($templateParams["spot"]) > 0): ?>
            <?php foreach ($templateParams["spot"] as $spot): ?>
                <div class="col-12 col-md-6 col-lg-4 spot-item">
                    <div class="card h-100 shadow-sm card-spot">
                        <div class="card-header bg-danger text-white d-flex align-items-center">
                            <h2 class="card-title mb-0 fs-5 text-truncate"><?php echo htmlspecialchars($spot["titolo"]); ?></h2>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted small"><i class="bi bi-chat-left-text"></i> Spot:</p>
                            <p class="card-text"><?php echo htmlspecialchars($spot["testo"]); ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="dettaglio-spot.php?id=<?php echo $spot['idSpot']; ?>" class="btn btn-outline-primary btn-sm">Leggi di più</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center my-5">
                <p class="lead">Nessuno spot trovato.</p>
                <a href="lista-categoria.php" class="btn btn-secondary">Resetta la ricerca</a>
            </div>
        <?php endif; ?>
    </div>

    <div class="text-center my-5" id="load-more-wrapper">
        <button id="btn-load-more" class="btn btn-danger btn-lg rounded-pill px-5 shadow">
            <i class="bi bi-arrow-down-circle"></i> Carica altri Spot
        </button>
    </div>

</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputRicerca = document.getElementById("ricerca");
        const containerSpot = document.getElementById("container-spot");
        const formRicerca = document.getElementById("form-ricerca");
        const btnLoadMore = document.getElementById("btn-load-more");
        const loadMoreWrapper = document.getElementById("load-more-wrapper");

        function eseguiRicerca() {
            const query = inputRicerca.value;
            const categories = Array.from(document.querySelectorAll('.check-filtro:checked')).map(cb => cb.value);

            if (query.length > 0 || categories.length > 0) {
                if(loadMoreWrapper) loadMoreWrapper.style.display = 'none';
            } else {
                if(loadMoreWrapper) loadMoreWrapper.style.display = 'block';
            }

            let url = `ricerca.php?ricerca=${encodeURIComponent(query)}`;
            categories.forEach(cat => {
                url += `&cat[]=${cat}`;
            });

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    containerSpot.innerHTML = "";
                    if (data.length > 0) {
                        data.forEach(spot => {
                            containerSpot.innerHTML += `
                            <div class="col-12 col-md-6 col-lg-4 spot-item"> <div class="card h-100 shadow-sm card-spot">
                                    <div class="card-header bg-danger text-white">
                                        <h2 class="card-title mb-0 fs-5 text-truncate">${spot.titolo}</h2>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-muted small"><i class="bi bi-chat-left-text"></i> Spot:</p>
                                        <p class="card-text">${spot.testo}</p>
                                    </div>
                                    <div class="card-footer bg-transparent border-top-0">
                                        <a href="dettaglio-spot.php?id=${spot.idSpot}" class="btn btn-outline-primary btn-sm">Leggi di più</a>
                                    </div>
                                </div>
                            </div>`;
                        });
                    } else {
                        containerSpot.innerHTML = '<div class="col-12 text-center my-5"><p class="lead">Nessuno spot trovato.</p></div>';
                    }
                })
                .catch(error => console.error("Errore AJAX Ricerca:", error));
        }

        if(inputRicerca) {
            inputRicerca.addEventListener("input", eseguiRicerca);
        }
        document.querySelectorAll('.check-filtro').forEach(checkbox => {
            checkbox.addEventListener("change", eseguiRicerca);
        });
        if(formRicerca) {
            formRicerca.addEventListener("submit", function(e) {
                e.preventDefault();
                eseguiRicerca();
            });
        }

        // caricare altri spot 
        if(btnLoadMore) {
            btnLoadMore.addEventListener("click", function() {

                const currentSpots = document.querySelectorAll(".spot-item").length;
                
                const originalText = btnLoadMore.innerHTML;
                btnLoadMore.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Caricamento...';
                btnLoadMore.disabled = true;

                const formData = new FormData();
                formData.append("offset", currentSpots);

                fetch("load-spots.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.html) {
                        containerSpot.insertAdjacentHTML('beforeend', data.html);
                    }

                    if (!data.hasMore) {
                        btnLoadMore.remove(); 
                        const endMsg = document.createElement("p");
                        endMsg.className = "text-center text-muted mt-3";
                        endMsg.innerText = "Non ci sono altri spot!";
                        loadMoreWrapper.appendChild(endMsg);
                    } else {
                        btnLoadMore.innerHTML = originalText;
                        btnLoadMore.disabled = false;
                    }
                })
                .catch(err => {
                    console.error("Errore AJAX Load More:", err);
                    btnLoadMore.innerHTML = originalText;
                    btnLoadMore.disabled = false;
                    alert("Errore nel caricamento. Riprova.");
                });
            });
        }
    });
</script>