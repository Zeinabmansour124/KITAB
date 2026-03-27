document.addEventListener('DOMContentLoaded', function() {
    const activeBtn = document.getElementById('activeBtn');
    const completedBtn = document.getElementById('completedBtn');
    const allBtn = document.getElementById('allBtn');

    const activeCont = document.getElementById('activeExchangesContainer');
    const completedCont = document.getElementById('completedExchangesContainer');
    const allCont = document.getElementById('allSection');

    function updateVisibility() {
        activeCont.style.display = 'none';
        completedCont.style.display = 'none';
        allCont.style.display = 'none';
        if (activeBtn.checked) activeCont.style.display = 'block';
        if (completedBtn.checked) completedCont.style.display = 'block';
        if (allBtn.checked) allCont.style.display = 'block';
    }
    activeBtn.addEventListener('change', updateVisibility);
    completedBtn.addEventListener('change', updateVisibility);
    allBtn.addEventListener('change', updateVisibility);
    updateVisibility();
});