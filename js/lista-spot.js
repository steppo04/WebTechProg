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
                        <div class="col-12 col-md-6 col-lg-4 spot-item" data-id="${spot.idSpot}"> 
                            <div class="card h-100 shadow-sm card-spot">
                                <div class="card-header bg-danger text-white">
                                    <h2 class="card-title mb-0 fs-5 text-truncate">${spot.titolo}</h2>
                                </div>
                                <div class="card-body">
                                    <p class="card-text text-muted small"><span class="bi bi-chat-left-text"></span> Spot:</p>
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


    if(btnLoadMore) {
        btnLoadMore.addEventListener("click", function() {

            const allSpots = document.querySelectorAll(".spot-item");
            const lastSpot = allSpots[allSpots.length - 1];
            
            if (!lastSpot) return; 

            const lastId = lastSpot.getAttribute("data-id");
            
            const originalText = btnLoadMore.innerHTML;
            btnLoadMore.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Caricamento...';
            btnLoadMore.disabled = true;

            const formData = new FormData();
            formData.append("lastId", lastId);

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