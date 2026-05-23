/**
 * ============================================================
 *  js/publish.js — Scripts de la page publish.php
 * ============================================================
 *
 *  Chargé uniquement sur publish.php via la variable $extraJs.
 *  Gère :
 *    - La prévisualisation de l'image sélectionnée
 *    - Le drag & drop de fichiers sur la zone d'upload
 *    - La réinitialisation du formulaire
 * ============================================================
 */

document.addEventListener('DOMContentLoaded', function () {

    // ── Références aux éléments du DOM ───────────────────
    const imageInput  = document.getElementById('imageInput');   // <input type="file">
    const uploadZone  = document.getElementById('uploadZone');   // Zone de dépôt visuelle
    const uploadPrev  = document.getElementById('uploadPreview');// Conteneur de l'aperçu
    const previewImg  = document.getElementById('previewImg');   // <img> d'aperçu
    const removeBtn   = document.getElementById('removeImg');    // Bouton × supprimer
    const resetBtn    = document.getElementById('resetBtn');     // Bouton Réinitialiser


    // ── Fonction utilitaire : affiche l'aperçu d'un fichier image ──
    function showPreview(file) {
        if (!file) return;

        // FileReader lit le fichier localement (sans requête serveur)
        const reader = new FileReader();

        // Callback déclenché une fois la lecture terminée
        reader.onload = function (e) {
            previewImg.src = e.target.result; // Data URL base64 de l'image
            uploadPrev.style.display = 'block';  // Affiche la prévisualisation
            uploadZone.style.display = 'none';   // Masque la zone de dépôt
        };

        // Lance la lecture en tant que Data URL (format base64)
        reader.readAsDataURL(file);
    }


    // ── Fonction utilitaire : réinitialise la zone d'upload ────────
    function resetUpload() {
        if (imageInput)  imageInput.value = ''; // Vide la valeur de l'input
        if (previewImg)  previewImg.src   = ''; // Supprime la source de l'image
        if (uploadPrev)  uploadPrev.style.display = 'none';  // Cache l'aperçu
        if (uploadZone)  uploadZone.style.display = 'block'; // Ré-affiche la zone
    }


    // ── Événement : sélection via clic sur l'input ─────────────────
    if (imageInput) {
        imageInput.addEventListener('change', function () {
            const file = this.files[0]; // Premier fichier sélectionné
            if (file) showPreview(file);
        });
    }


    // ── Événement : bouton × pour supprimer l'image sélectionnée ───
    if (removeBtn) {
        removeBtn.addEventListener('click', resetUpload);
    }


    // ── Drag & Drop ────────────────────────────────────────────────

    if (uploadZone) {

        // Empêche le comportement par défaut du navigateur (ouvrir le fichier)
        uploadZone.addEventListener('dragover', function (e) {
            e.preventDefault();
            uploadZone.classList.add('drag-over'); // Ajoute un style visuel
        });

        // Retire le style visuel quand le curseur quitte la zone
        uploadZone.addEventListener('dragleave', function () {
            uploadZone.classList.remove('drag-over');
        });

        // Gère le dépôt du fichier sur la zone
        uploadZone.addEventListener('drop', function (e) {
            e.preventDefault();                          // Empêche l'ouverture dans le navigateur
            uploadZone.classList.remove('drag-over');    // Retire le style

            const dt    = e.dataTransfer;                // Objet DataTransfer
            const files = dt.files;                      // Liste des fichiers déposés

            if (files && files.length > 0) {
                // Injecte le fichier dans l'input (pour qu'il soit envoyé avec le formulaire)
                // Note : DataTransfer.files est en lecture seule en général,
                //        donc on passe par l'événement change manuellement.
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(files[0]);        // Prend seulement le 1er fichier
                imageInput.files = dataTransfer.files;   // Met à jour l'input
                showPreview(files[0]);                   // Affiche la prévisualisation
            }
        });
    }


    // ── Réinitialisation du formulaire complet ─────────────────────
    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            // Le bouton type="reset" réinitialise déjà les champs HTML,
            // mais il faut aussi réinitialiser manuellement la prévisualisation.
            resetUpload();
        });
    }

});
