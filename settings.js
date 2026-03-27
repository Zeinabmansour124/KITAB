// ===== TABS =====
const tabs = document.querySelectorAll(".tab");
const sections = document.querySelectorAll("[data-content]");

tabs.forEach(tab => {
    tab.addEventListener("click", () => {

        // 1️⃣ Active le tab visuellement
        tabs.forEach(t => t.classList.remove("active"));
        tab.classList.add("active");

        // 2️⃣ Récupère le target du tab
        const target = tab.dataset.tab;

        // 3️⃣ Affiche les sections correspondantes
        sections.forEach(section => {
            if (section.dataset.content === target) {
                section.classList.remove("hidden");
            } else {
                section.classList.add("hidden");
            }
        });
    });
});

// ===== MODE SWITCH =====
const modes = document.querySelectorAll(".mode-box");

modes.forEach(mode => {
    mode.addEventListener("click", () => {

        // 1️⃣ Active le bouton mode visuellement
        modes.forEach(m => m.classList.remove("active"));
        mode.classList.add("active");

        // 2️⃣ Récupère le mode choisi
        const selected = mode.dataset.mode;

        // 3️⃣ Supprime toutes les classes de mode
        document.body.classList.remove("dark-mode", "light-mode");

        if (selected === "dark") {
            document.body.classList.add("dark-mode");
        } else if (selected === "light") {
            document.body.classList.add("light-mode");
        } else {
            // system mode : revenir aux styles par défaut
            document.body.classList.remove("dark-mode", "light-mode");
        }

        // 4️⃣ Ajuste tous les éléments fixes pour le mode
        document.querySelectorAll(".card, input, textarea, button").forEach(el => {
            if (selected === "dark") {
                el.style.backgroundColor = "#1e1e1e";
                el.style.color = "#f5f5f5";
                if (el.tagName === "INPUT" || el.tagName === "TEXTAREA") {
                    el.style.borderColor = "#555";
                }
            } else if (selected === "light") {
                el.style.backgroundColor = "#fffdf8";
                el.style.color = "#1a1208";
                if (el.tagName === "INPUT" || el.tagName === "TEXTAREA") {
                    el.style.borderColor = "#ccc";
                }
            } else {
                // reset system
                el.style.backgroundColor = "";
                el.style.color = "";
                if (el.tagName === "INPUT" || el.tagName === "TEXTAREA") {
                    el.style.borderColor = "";
                }
            }
        });
    });
});

// ===== FONT SIZE =====
const slider = document.getElementById("fontSizeSlider");

slider.addEventListener("input", () => {
    document.documentElement.style.fontSize = slider.value + "px";
});