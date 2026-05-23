document.addEventListener('DOMContentLoaded', function () {
    const activeBtn = document.getElementById('activeBtn');
    const completedBtn = document.getElementById('completedBtn');
    const allBtn = document.getElementById('allBtn');

    const exchangeAccepted = document.getElementById('exchange-Accepted');
    const pendingExchanges = document.getElementById('pending-Exchanges');
    const completedExchanges = document.getElementById('completed-Exchanges');
    const refusedExchanges = document.getElementById('refused-Exchanges');
    const inProgressExchanges = document.getElementById('in-progress-Exchanges');

    function updateVisibility() {
        const sections = [exchangeAccepted, pendingExchanges, completedExchanges, refusedExchanges, inProgressExchanges];
        sections.forEach(sec => {
            if (sec) sec.style.display = 'none';
        });

        if (activeBtn && activeBtn.checked) {
            if (exchangeAccepted) exchangeAccepted.style.display = 'block';
            if (pendingExchanges) pendingExchanges.style.display = 'block';
            if (inProgressExchanges) inProgressExchanges.style.display = 'block';
        }
        else if (completedBtn && completedBtn.checked) {
            if (completedExchanges) completedExchanges.style.display = 'block';
        }
        else if (allBtn && allBtn.checked) {
            sections.forEach(sec => {
                if (sec) sec.style.display = 'block';
            });
        }
    }

    if (activeBtn) activeBtn.addEventListener('change', updateVisibility);
    if (completedBtn) completedBtn.addEventListener('change', updateVisibility);
    if (allBtn) allBtn.addEventListener('change', updateVisibility);
    updateVisibility();

    // ========== BOUTONS CHAT (avec vérification) ==========
    const chatButtonAccepted = document.getElementById('chat-button-Accepted');
    if (chatButtonAccepted) chatButtonAccepted.addEventListener('click', function () { });

    const chatButtonPending = document.getElementById('chat-button-pending');
    if (chatButtonPending) chatButtonPending.addEventListener('click', function () { });

    const chatButtonCompleted = document.getElementById('chat-button-completed');
    if (chatButtonCompleted) chatButtonCompleted.addEventListener('click', function () { });

    const chatButtonRefused = document.getElementById('chat-button-refused');
    if (chatButtonRefused) chatButtonRefused.addEventListener('click', function () { });

    const chatButtonInProgress = document.getElementById('chat-button-in-progress');
    if (chatButtonInProgress) chatButtonInProgress.addEventListener('click', function () { });

    // ========== BOUTON ACCEPT ==========
    const acceptBtn = document.getElementById('accept-request');
    if (acceptBtn) {
        acceptBtn.addEventListener('click', function (e) {
            e.preventDefault();
            
            const container = this.closest('[data-exchange-id]');
            if (!container) {
                showNotification('Erreur: Échange non identifié', 'error');
                return;
            }
            
            const exchangeId = container.dataset.exchangeId;
            
            if (confirm('Are you sure you want to accept this exchange request?')) {
                fetch('update_exchange_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        exchangeId: exchangeId,
                        status: 'accepted'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Exchange accepted successfully!', 'success');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showNotification('Failed to accept the exchange.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Network error. Please try again.', 'error');
                });
            }
        });
    }

    // ========== BOUTON DECLINE ==========
    const declineBtn = document.getElementById('decline-request');
    if (declineBtn) {
        declineBtn.addEventListener('click', function (e) {
            e.preventDefault();
            
            const container = this.closest('[data-exchange-id]');
            if (!container) {
                showNotification('Erreur: Échange non identifié', 'error');
                return;
            }
            
            const exchangeId = container.dataset.exchangeId;
            
            if (confirm('Are you sure you want to decline this exchange request?')) {
                fetch('update_exchange_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        exchangeId: exchangeId,
                        status: 'declined'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Exchange declined successfully!', 'success');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showNotification('Failed to decline the exchange.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Network error. Please try again.', 'error');
                });
            }
        });
    }
});

// ========== FONCTION NOTIFICATION ==========
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.textContent = message;

    let backgroundColor = '#17a2b8';
    if (type === 'success') backgroundColor = '#28a745';
    if (type === 'error') backgroundColor = '#dc3545';

    notification.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        padding: 12px 24px;
        background-color: ${backgroundColor};
        color: white;
        border-radius: 8px;
        font-weight: 500;
        z-index: 10000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: fadeInOut 3s ease;
    `;

    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);
}