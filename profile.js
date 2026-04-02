/**
 * Met à jour l'interface de progression avec animations et couleurs dynamiques
 * @param {number} currentPx - XP actuel (ex: 45)
 * @param {number} totalPx - XP max pour ce niveau (ex: 100)
 * @param {string} nextLevelName - Nom du prochain niveau (ex: "Level 2 - Silver")
 * @param {string} currentLevelName - Nom du niveau actuel (optionnel)
 */
function updateStatusFromBackend(currentPx, totalPx, nextLevelName, currentLevelName = "Bronze") {
    // 1. Calcul du pourcentage
    let percentage = (currentPx / totalPx) * 100;
    percentage = Math.min(Math.max(percentage, 0), 100);
    
    // 2. Mise à jour des éléments
    const scoreNum = document.getElementById('current-score-num');
    const barFill = document.getElementById('progress-bar-fill');
    const remainingPxSpan = document.getElementById('remaining-px');
    const remainingLevelSpan = document.getElementById('remaining-level');
    const userLevelSpan = document.getElementById('user-reading-level');
    
    // 3. Animation des nombres (effet de compteur)
    if (scoreNum) {
        animateNumber(parseInt(scoreNum.innerText) || 0, currentPx, 600, (val) => {
            scoreNum.innerText = Math.floor(val);
        });
    }
    
    // 4. Animation de la barre
    if (barFill) {
        barFill.style.width = percentage + "%";
        // Option: changer la couleur selon le pourcentage
        if (percentage < 30) {
            barFill.style.background = "linear-gradient(90deg, #8b5a2b, #c97e3a)";
        } else if (percentage < 70) {
            barFill.style.background = "linear-gradient(90deg, #3b5d50, #5a8f7a)";
        } else {
            barFill.style.background = "linear-gradient(90deg, #2c8c5a, #7fb09c, #ffd966)";
        }
    }
    
    // 5. Mise à jour des textes restants
    const remainingPx = totalPx - currentPx;
    if (remainingPxSpan) remainingPxSpan.innerText = remainingPx;
    if (remainingLevelSpan) remainingLevelSpan.innerText = nextLevelName;
    if (userLevelSpan) userLevelSpan.innerText = currentLevelName;
    
    // 6. Ajout d'un effet visuel subtil
    addStatusAnimation();
}

/**
 * Animation de compteur (de start à end)
 */
function animateNumber(start, end, duration, callback) {
    const startTime = performance.now();
    const difference = end - start;
    
    function update(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const easeOut = 1 - Math.pow(1 - progress, 3); // easing cubic
        const currentValue = start + (difference * easeOut);
        
        callback(currentValue);
        
        if (progress < 1) {
            requestAnimationFrame(update);
        }
    }
    
    requestAnimationFrame(update);
}

/**
 * Petit effet de flash pour indiquer la mise à jour
 */
function addStatusAnimation() {
    const statusBlock = document.querySelector('.rounded-4.bg-white');
    if (statusBlock) {
        statusBlock.style.transition = 'background 0.2s ease';
        statusBlock.style.background = '#f0f9f5';
        setTimeout(() => {
            statusBlock.style.background = '';
        }, 300);
    }
}

// === EXEMPLE D'UTILISATION (à connecter à votre backend) ===
setTimeout(() => {
    // currentXP, maxXP, prochainNiveau, niveauActuel
    updateStatusFromBackend(0, 100, "Level 1 - Explorer", "Level 0 - Novice");
}, 500);
btnEdit=document.getElementById("edit-profile-btn");
btnEdit.addEventListener("click",function(){
    window.location.href="settings.html";
});