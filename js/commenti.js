document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('formCommento');
    const container = document.getElementById('containerCommenti');
    const alertRisposta = document.getElementById('alertRisposta');
    const inputCommento = document.getElementById('commento');

    const alertMessageContainer = document.getElementById('alertMessageContainer');
    const alertText = document.getElementById('alertText');
    const alertIcon = document.getElementById('alertIcon');

    function mostraMessaggio(messaggio, isErrore = true) {
        if (!alertMessageContainer || !alertText || !alertIcon) return;

        alertText.textContent = messaggio;

        //gestione tipo messaggio
        if (isErrore) {
            alertMessageContainer.classList.remove('alert-success');
            alertMessageContainer.classList.add('alert-danger');
            alertIcon.className = 'bi bi-exclamation-triangle-fill me-2';
            if (inputCommento) inputCommento.classList.add('is-invalid');
        } else {
            alertMessageContainer.classList.remove('alert-danger');
            alertMessageContainer.classList.add('alert-success');
            alertIcon.className = 'bi bi-check-circle-fill me-2';
            if (inputCommento) inputCommento.classList.remove('is-invalid');
        }

        alertMessageContainer.classList.remove('d-none');
    }

    window.chiudiAlert = function () {
        if (alertMessageContainer) {
            alertMessageContainer.classList.add('d-none');
        }
        if (inputCommento) {
            inputCommento.classList.remove('is-invalid');
        }
    };

    //se scrivo tolgo il banner rosso
    if (inputCommento) {
        inputCommento.addEventListener('input', function () {
            if (this.classList.contains('is-invalid')) {
                this.classList.remove('is-invalid');
                window.chiudiAlert();
            }
        });
    }

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            window.chiudiAlert();

            const formData = new FormData(form);

            if (!formData.get('testo') || formData.get('testo').trim() === '') {
                mostraMessaggio("Il commento non può essere vuoto.", true);
                return;
            }

            fetch('aggiungi-commento.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {

                        const counterElement = document.getElementById('numeroCommenti');
                        if (counterElement) {
                            let currentCount = parseInt(counterElement.textContent);
                            counterElement.textContent = currentCount + 1;
                        }

                        let htmlRisposta = '';
                        //dati del padre
                        if (data.data.haRisposto) {
                            htmlRisposta = `
                            <div class="bg-light border-start border-secondary border-2 p-1 mb-2 rounded shadow-sm" style="font-size: 0.75rem; opacity: 0.8;">
                                <span class="text-muted fw-bold"><i class="bi bi-quote"></i> In risposta a ${data.data.autorePadre}:</span>
                                <p class="mb-0 text-truncate fst-italic">"${data.data.testoPadre}"</p>
                            </div>`;
                        }

                        //dati del commento
                        const nuovoCommentoHTML = `
                        <div class="list-group-item border-start border-danger border-4 mb-2 shadow-sm rounded animate__animated animate__fadeIn" style="background-color: #fff3cd; transition: background-color 1s ease;">
                            ${htmlRisposta}
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <img src="${data.data.fotoProfilo}" alt="Foto" class="rounded-circle me-2" style="width: 30px; height: 30px; object-fit: cover;">
                                    <h4 class="mb-0 fw-bold fs-6">${data.data.username}</h4>
                                </div>
                                <small class="text-muted">Adesso</small>
                            </div>
                            <p class="mb-1 small">${data.data.testo}</p>
                            <div class="text-end">
                                <a href="?id=${data.data.idSpot}&rspTo=${data.data.idCommento}#formCommento" class="text-decoration-none small fw-bold text-danger" style="font-size: 0.75rem;"><i class="bi bi-reply"></i> Rispondi</a>
                            </div>
                        </div>`;

                        if (container.querySelector('p.text-muted') && container.children.length === 1) {
                            container.innerHTML = '';
                        }
                        container.insertAdjacentHTML('beforeend', nuovoCommentoHTML);

                        //inserisco un timer
                        const nuovoElemento = container.lastElementChild;
                        nuovoElemento.scrollIntoView({ behavior: 'smooth' });
                        setTimeout(() => {
                            if (nuovoElemento) {
                                nuovoElemento.style.backgroundColor = 'transparent';
                            }
                        }, 4000);

                        form.reset();
                        if (alertRisposta) alertRisposta.style.display = 'none';
                        const url = new URL(window.location.href);
                        url.searchParams.delete('rspTo');
                        window.history.replaceState({}, '', url);
                        const inputHiddenRsp = form.querySelector('input[name="idCommentoRisposto"]');
                        if (inputHiddenRsp) inputHiddenRsp.value = '';

                    } else {
                        mostraMessaggio(data.message, true);
                    }
                })
                .catch(error => {
                    console.error('Errore:', error);
                    mostraMessaggio("Si è verificato un errore di connessione.", true);
                });
        });
    }

    //se cancello la rispota
    const btnChiudiRisposta = document.querySelector('#alertRisposta .btn-close');
    if (btnChiudiRisposta) {
        btnChiudiRisposta.addEventListener('click', function () {
            const url = new URL(window.location.href);
            url.searchParams.delete('rspTo');
            window.history.replaceState({}, '', url);
            document.getElementById('alertRisposta').style.display = 'none';
            document.querySelector('input[name="idCommentoRisposto"]').value = '';
        });
    }
});