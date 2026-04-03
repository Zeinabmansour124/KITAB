/**
 * ============================================================
 *  js/main.js — Scripts globaux KITAB
 * ============================================================
 *
 *  Chargé sur toutes les pages via includes/footer.php.
 *  Contient uniquement les comportements partagés.
 * ============================================================
 */

// ── Attendre que le DOM soit entièrement chargé ────────────
document.addEventListener('DOMContentLoaded', function () {

    // ── Fermeture automatique des alertes ─────────────────
    //   Les alertes (.alert) disparaissent après 5 secondes
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function (alert) {
        setTimeout(function () {
            // Transition opacity avant de masquer
            alert.style.transition = 'opacity .5s ease';
            alert.style.opacity    = '0';
            // Supprime l'élément du DOM après la transition
            setTimeout(function () { alert.remove(); }, 500);
        }, 5000); // 5000 ms = 5 secondes
    });

});
