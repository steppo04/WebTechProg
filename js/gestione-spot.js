document.addEventListener("DOMContentLoaded", function() {
    const formSpot = document.getElementById("form-spot");
    const categoriaSelect = document.getElementById("categoria");
    const sottocategoriaSelect = document.getElementById("sottocategoria");

    if (!formSpot || !categoriaSelect) return; 

    function caricaSottocategorie(idCategoria, idSelezionata = null) {
        if (!idCategoria) {
            sottocategoriaSelect.innerHTML = '<option value="">Seleziona categoria...</option>';
            return;
        }

        fetch(`get-subcategories.php?id=${idCategoria}`)
            .then(response => response.json())
            .then(data => {
                sottocategoriaSelect.innerHTML = '<option value="">Seleziona Sottocategoria...</option>';
                data.forEach(sub => {
                    const opt = document.createElement("option");
                    opt.value = sub.idSottoCategoria;
                    opt.textContent = sub.nome;
                    if (idSelezionata && sub.idSottoCategoria == idSelezionata) opt.selected = true;
                    sottocategoriaSelect.appendChild(opt);
                });
            })
            .catch(err => console.error("Errore AJAX:", err));
    }

    categoriaSelect.addEventListener("change", function() {
        caricaSottocategorie(this.value);
    });

    const isEdit = formSpot.dataset.isEdit === 'true';
    const initCat = formSpot.dataset.initCat;
    const initSubCat = formSpot.dataset.initSubCat;

    if (isEdit && initCat) {
        caricaSottocategorie(initCat, initSubCat);
    }
});