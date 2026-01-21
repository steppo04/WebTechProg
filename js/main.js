document.addEventListener("DOMContentLoaded", function() {
    // la gestione toast
    const toastEl = document.getElementById('liveToast');
    if (toastEl) {
        const toast = new bootstrap.Toast(toastEl, {
            delay: 4000
        });
        toast.show();
    }

    const modalFiltri = document.getElementById('modalFiltri');
    
    const formFiltri = document.getElementById('formFiltri') || document.getElementById('form-ricerca');

    if (modalFiltri && formFiltri) {
        modalFiltri.addEventListener('hide.bs.modal', function(event) {
            formFiltri.submit();
        });
    }

    // notifiche 
    const badgeContainer = document.getElementById("notification-badge-container");

    function updateNotificationCount() {
        if (!badgeContainer) return;

        fetch('notifiche-count.php')
            .then(response => response.json())
            .then(data => {
                if (data.count > 0) {
                    badgeContainer.innerHTML = `
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.7rem;">
                            ${data.count}
                            <span class="visually-hidden">notifiche non lette</span>
                        </span>`;
                } else {
                    badgeContainer.innerHTML = "";
                }
            })
            .catch(error => console.error("Errore nel recupero notifiche:", error));
    }

    if (badgeContainer) {
        setInterval(updateNotificationCount, 30000);
    }

    const deleteButtons = document.querySelectorAll('.btn-confirm-delete');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const message = this.dataset.confirmMsg || 'Sei sicuro di voler procedere con questa operazione?';
            
            if (!confirm(message)) {
                event.preventDefault(); 
            }
        });
    });
});