document.addEventListener("DOMContentLoaded", function() {
    const usernameInput = document.getElementById("username");
    
    let feedbackDiv = document.getElementById("username-feedback");
    if (!feedbackDiv) {
        feedbackDiv = document.createElement("div");
        feedbackDiv.id = "username-feedback";
        feedbackDiv.className = "invalid-feedback fw-bold"; 
        usernameInput.parentNode.appendChild(feedbackDiv);
    }

    let timeout = null;

    usernameInput.addEventListener("input", function() {
        const username = usernameInput.value.trim();

        usernameInput.classList.remove("is-valid", "is-invalid");
        feedbackDiv.style.display = "none";
        
        if (username.length === 0) return;

        clearTimeout(timeout);

        // impostiamo timeout di 500ms
        timeout = setTimeout(() => {
            checkUsername(username);
        }, 500);
    });

    function checkUsername(username) {
        fetch("check-username.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "username=" + encodeURIComponent(username)
        })
        .then(response => response.json())
        .then(data => {
            if (data.taken) {
                // username non disponibile
                usernameInput.classList.add("is-invalid");
                usernameInput.classList.remove("is-valid");
                feedbackDiv.textContent = "Attenzione: Username già in uso!";
                feedbackDiv.style.display = "block";
            } else {
                // username disponibile
                usernameInput.classList.add("is-valid");
                usernameInput.classList.remove("is-invalid");
            }
        })
        .catch(error => console.error("Errore controllo username:", error));
    }
});