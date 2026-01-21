document.addEventListener("DOMContentLoaded", function() {
    const btnChangePhoto = document.getElementById('btnChangePhoto');
    const fileInput = document.getElementById('fileToUpload');
    const profileForm = document.getElementById('profileForm');

    if (btnChangePhoto && fileInput && profileForm) {
        btnChangePhoto.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                profileForm.submit();
            }
        });
    }
});