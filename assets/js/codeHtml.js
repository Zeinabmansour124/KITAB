document.addEventListener('DOMContentLoaded', function () {

    // ========== SYSTEM DE FILTRAGE ==========
    const filterRadios = document.querySelectorAll('.exchange-filter');

    const exchangeAccepted    = document.getElementById('exchange-Accepted');
    const pendingExchanges    = document.getElementById('pending-Exchanges');
    const completedExchanges  = document.getElementById('completed-Exchanges');
    const refusedExchanges    = document.getElementById('refused-Exchanges');
    const inProgressExchanges = document.getElementById('in-progress-Exchanges');

    const allSections = [exchangeAccepted, pendingExchanges, completedExchanges, refusedExchanges, inProgressExchanges];

    function updateVisibility() {
        allSections.forEach(sec => { if (sec) sec.style.display = 'none'; });

        const checkedRadio = document.querySelector('.exchange-filter:checked');
        if (!checkedRadio) return;

        if (checkedRadio.id === 'activeBtn') {
            [exchangeAccepted, pendingExchanges, inProgressExchanges].forEach(sec => {
                if (sec) sec.style.display = 'block';
            });
        } else if (checkedRadio.id === 'completedBtn') {
            [completedExchanges, refusedExchanges].forEach(sec => {
                if (sec) sec.style.display = 'block';
            });
        } else if (checkedRadio.id === 'allBtn') {
            allSections.forEach(sec => { if (sec) sec.style.display = 'block'; });
        }
    }

    filterRadios.forEach(radio => {
        radio.addEventListener('change', updateVisibility);
    });

    // Lancement au chargement de la page
    updateVisibility();

    // ========== INTERACTION SYNC (ACCEPT / DECLINE) ==========
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('accept-btn')) {
            e.preventDefault();
            const container = e.target.closest('.pending-card');
            if (!container) return;
            const exchangeId = container.dataset.exchangeId;

            if (confirm('Are you sure you want to accept this exchange request?')) {
                window.location.href = `traitementExchange.php?action=accept&id=${exchangeId}`;
            }
        }

        if (e.target.classList.contains('decline-btn')) {
            e.preventDefault();
            const container = e.target.closest('.pending-card');
            if (!container) return;
            const exchangeId = container.dataset.exchangeId;

            if (confirm('Are you sure you want to decline this exchange request?')) {
                window.location.href = `traitementExchange.php?action=decline&id=${exchangeId}`;
            }
        }
    });
});