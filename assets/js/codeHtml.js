document.addEventListener('DOMContentLoaded', function () {

    // ==========================================
    // 1. GESTION DES ONGLETS (FILTRES DE STATUT)
    // ==========================================

    // Sélection des boutons radio de filtrage
    const activeBtn = document.getElementById("activeBtn");
    const completedBtn = document.getElementById("completedBtn");
    const allBtn = document.getElementById("allBtn");

    // Sélection des sections d'échange
    const acceptedSection = document.getElementById("exchange-Accepted");
    const pendingSection = document.getElementById("pending-Exchanges");
    const completedSection = document.getElementById("completed-Exchanges");
    // CORRECTION : "in-progress" avec un p minuscule pour correspondre exactement au PHP
    const inProgressSection = document.getElementById("in-progress-Exchanges"); 
    const refusedSection = document.getElementById("refused-Exchanges");

    function appliquerFiltre() {
        // ÉTAPE 1 : On commence par cacher ABSOLUMENT TOUTES les sections systématiquement
        if (acceptedSection) acceptedSection.style.setProperty("display", "none", "important");
        if (pendingSection) pendingSection.style.setProperty("display", "none", "important");
        if (completedSection) completedSection.style.setProperty("display", "none", "important");
        if (inProgressSection) inProgressSection.style.setProperty("display", "none", "important");
        if (refusedSection) refusedSection.style.setProperty("display", "none", "important");

        // ÉTAPE 2 : On affiche uniquement celles demandées par l'onglet actif
        if (activeBtn && activeBtn.checked) {
            // Mode Actif : On montre Accepté et En Attente
            if (acceptedSection) acceptedSection.style.setProperty("display", "flex", "important");
            if (pendingSection) pendingSection.style.setProperty("display", "flex", "important");
            if (inProgressSection) inProgressSection.style.setProperty("display", "flex", "important");
        } else if (completedBtn && completedBtn.checked) {
            // Mode Complété : On montre uniquement Complété
            if (completedSection) completedSection.style.setProperty("display", "flex", "important");
        } else if (allBtn && allBtn.checked) {
            // Mode Global : On affiche tout !
            if (acceptedSection) acceptedSection.style.setProperty("display", "flex", "important");
            if (pendingSection) pendingSection.style.setProperty("display", "flex", "important");
            if (completedSection) completedSection.style.setProperty("display", "flex", "important");
            if (inProgressSection) inProgressSection.style.setProperty("display", "flex", "important");
            if (refusedSection) refusedSection.style.setProperty("display", "flex", "important");
        }
    }

    // Écouteurs d'événements sur chaque bouton radio
    if (activeBtn) activeBtn.addEventListener("change", appliquerFiltre);
    if (completedBtn) completedBtn.addEventListener("change", appliquerFiltre);
    if (allBtn) allBtn.addEventListener("change", appliquerFiltre);

    // Lancer une première fois au chargement pour initialiser l'affichage
    appliquerFiltre();


    // ==========================================
    // 2. GESTION DE LA BARRE DE RECHERCHE TEMPS RÉEL
    // ==========================================
    
    const searchInput = document.querySelector("#search-tool input[type='text']");

    if (searchInput) {
        searchInput.addEventListener("input", function (e) {
            const searchTerm = e.target.value.toLowerCase().trim();
            
            // Cible les cartes d'échanges générées dans les boucles
            const exchangeCards = document.querySelectorAll(".position-relative.empl, .pending-card");

            exchangeCards.forEach(function (card) {
                const cardText = card.textContent.toLowerCase();

                // Si la recherche correspond, on affiche la carte, sinon on la cache
                if (cardText.includes(searchTerm)) {
                    card.style.setProperty("display", "flex", "important");
                } else {
                    card.style.setProperty("display", "none", "important");
                }
            });
        });
    }


    // ==========================================
    // 3. SYSTÈME DE NOTIFICATION TOAST
    // ==========================================

    window.showNotification = function(message, type) {
        const colors = { success: '#28a745', error: '#dc3545', info: '#17a2b8' };
        const notification = document.createElement('div');

        notification.textContent = message;
        notification.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 12px 24px;
            background-color: ${colors[type] || colors.info};
            color: white;
            border-radius: 8px;
            font-weight: 500;
            z-index: 10000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: opacity 0.3s ease;
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 300);
        }, 2700);
    };

});