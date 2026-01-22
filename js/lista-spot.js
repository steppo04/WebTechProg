document.addEventListener("DOMContentLoaded", function() {
    const inputRicerca = document.getElementById("ricerca");
    const containerSpot = document.getElementById("container-spot");
    const formRicerca = document.getElementById("form-ricerca");

    function eseguiRicerca() {
        const query = inputRicerca.value;
        const categories = Array.from(document.querySelectorAll('.check-filtro:checked')).map(cb => cb.value);

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
                        
                        let favButtonHtml = '';
                        if (spot.isUserLoggedIn) {
                            const iconClass = spot.isPreferito ? 'bi-bookmark-fill' : 'bi-bookmark';
                            favButtonHtml = `
                                <button type="button" class="btn btn-link text-white p-0 btn-toggle-preferito" 
                                        data-id="${spot.idSpot}" 
                                        title="Salva nei preferiti">
                                    <span class="bi ${iconClass} fs-4"></span>
                                </button>`;
                        }

                        containerSpot.innerHTML += `
                        <div class="col-12 col-md-6 col-lg-4 spot-item" data-id="${spot.idSpot}"> 
                            <article class="card h-100 shadow-sm card-spot">
                                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                                    <h2 class="card-title mb-0 fs-5 text-truncate" style="max-width: 80%;">${spot.titolo}</h2>
                                    ${favButtonHtml}
                                </div>
                                <div class="card-body">
                                    <p class="card-text text-muted small"><span class="bi bi-chat-left-text"></span> Spot:</p>
                                    <p class="card-text">${spot.testo}</p>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <a href="dettaglio-spot.php?id=${spot.idSpot}" class="btn btn-outline-primary btn-sm">Leggi di più</a>
                                </div>
                            </article>
                        </div>`;
                    });
                } else {
                    containerSpot.innerHTML = `<div class="col-12 text-center my-5">
                        <p class="lead">Nessuno spot trovato.</p>
                        <a href="lista-categoria.php" class="btn btn-secondary">Resetta la ricerca</a>
                    </div>`;
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

});