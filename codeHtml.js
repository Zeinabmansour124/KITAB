document.addEventListener('DOMContentLoaded', function () {
    const activeBtn = document.getElementById('activeBtn');
    const completedBtn = document.getElementById('completedBtn');
    const allBtn = document.getElementById('allBtn');

    // On récupère les sections
    const exchangeAccepted = document.getElementById('exchange-Accepted');
    const pendingExchanges = document.getElementById('pending-Exchanges');
    const completedExchanges = document.getElementById('completed-Exchanges');
    const refusedExchanges = document.getElementById('refused-Exchanges');
    const inProgressExchanges = document.getElementById('in-progress-Exchanges');

    function updateVisibility() {
        // Liste de toutes nos sections pour boucler dessus facilement
        const sections = [exchangeAccepted, pendingExchanges, completedExchanges, refusedExchanges, inProgressExchanges];

        // On cache tout par défaut (si la section existe)
        sections.forEach(sec => {
            if (sec) sec.style.setProperty('display', 'none', 'important');
        });

        if (activeBtn && activeBtn.checked) {
            if (exchangeAccepted) exchangeAccepted.style.setProperty('display', 'block', 'important');
            if (pendingExchanges) pendingExchanges.style.setProperty('display', 'block', 'important');
            if (inProgressExchanges) inProgressExchanges.style.setProperty('display', 'block', 'important');
        }
        else if (completedBtn && completedBtn.checked) {
            if (completedExchanges) completedExchanges.style.setProperty('display', 'block', 'important');
        }
        else if (allBtn && allBtn.checked) {
            sections.forEach(sec => {
                if (sec) sec.style.setProperty('display', 'block', 'important');
            });
        }
    }

    // Écouteurs d'événements
    if (activeBtn) activeBtn.addEventListener('change', updateVisibility);
    if (completedBtn) completedBtn.addEventListener('change', updateVisibility);
    if (allBtn) allBtn.addEventListener('change', updateVisibility);

    // Lancement immédiat pour l'état initial
    updateVisibility();



});

//upload the exchange data from the server and display it in the page
document.addEventListener('DOMContentLoaded', function () {
});

//manipuler les statiques a chaque fois que la page est chargée
document.addEventListener('DOMContentLoaded', function () {
});

//ouvrir les chats relative a chaque type d echange 
const chatButtonAccepted = document.getElementById('chat-button-Accepted');
chatButtonAccepted.addEventListener('click', function () { });

chatButtonPending = document.getElementById('chat-button-pending');
chatButtonPending.addEventListener('click', function () { });

chatButtonCompleted = document.getElementById('chat-button-completed');
chatButtonCompleted.addEventListener('click', function () { });

chatButtonRefused = document.getElementById('chat-button-refused');
chatButtonRefused.addEventListener('click', function () { });

chatButtonInProgress = document.getElementById('chat-button-in-progress');
chatButtonInProgress.addEventListener('click', function () { });
//accepter ou refuser les demandes d echange
const acceptBtn = document.getElementById('accept-request');
acceptBtn.addEventListener('click', function () { });
const declineBtn = document.getElementById('decline-request');
declineBtn.addEventListener('click', function () { });
