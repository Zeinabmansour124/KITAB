const bouton = document.createElement("button");
bouton.textContent = "🌙 Dark";
bouton.id = "mode-toggle-btn";
document.body.appendChild(bouton);

bouton.style.cssText = `
  position: fixed;
  bottom: 28px;
  right: 28px;
  z-index: 9999;
  padding: 10px 20px;
  border-radius: 50px;
  border: 1px solid var(--border);
  background: var(--white);
  color: var(--amber);
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  font-weight: 700;
  cursor: pointer;
  box-shadow: 0 4px 15px rgba(26,18,8,.15);
  transition: all 0.25s ease;
`;

bouton.addEventListener("mouseenter", function () {
  bouton.style.background = "var(--amber)";
  bouton.style.color = "white";
  bouton.style.transform = "translateY(-2px)";
  bouton.style.boxShadow = "0 6px 18px rgba(200,134,10,.25)";
});

bouton.addEventListener("mouseleave", function () {
  if (!modeEstSombre) {
    bouton.style.background = "var(--white)";
    bouton.style.color = "var(--amber)";
  } else {
    bouton.style.background = "var(--ink)";
    bouton.style.color = "var(--amber-mid)";
  }
  bouton.style.transform = "translateY(0)";
  bouton.style.boxShadow = "0 4px 15px rgba(26,18,8,.15)";
});

const stylesDark = `
  body, .content          { background-color: #16110b !important; color: #f5f0e8 !important; }
  .sidebar                { background-color: #1a1208 !important; }
  .page-header            { background: linear-gradient(105deg, #1a1208 0%, #0a5046 60%, #8b3a1a 100%) !important; }
  .page-body              { background-color: #16110b !important; }
  .room-card              { background-color: #241a11 !important; border-color: #3a2a1b !important; }
  .stat-card              { background-color: #241a11 !important; }
  .search-area            { background-color: #1a1208 !important; }
  .search-bar             { background-color: rgba(255,255,255,.08) !important; color: #f9efd0 !important; border-color: rgba(255,255,255,.12) !important; }
  .search-bar::placeholder { color: rgba(255,253,248,.35) !important; }
  .room-content h3        { color: #fffdf8 !important; }
  .room-author            { color: #cbbba8 !important; }
  .progress-text          { color: #cbbba8 !important; }
  .host-name              { color: #fffdf8 !important; }
  .host-role              { background: rgba(200,134,10,.12) !important; color: #f9c85b !important; }
  .tag                    { background: rgba(255,255,255,.05) !important; border-color: #3a2a1b !important; color: #f9c85b !important; }
  .stat-title             { color: #cbbba8 !important; }
  .progress-bar-bg        { background: #3a2a1b !important; }
  hr.separator            { border-top-color: #3a2a1b !important; }
`;

const baliseStyle = document.createElement("style");
baliseStyle.id = "dark-mode-style";
document.head.appendChild(baliseStyle);

let modeEstSombre = false;

// Fonction globale appelée par traduction.js pour changer la langue du bouton
window.updateModeButton = function () {
  const t = window.currentTranslations || {
    mode_dark: "Dark",
    mode_light: "Light",
  };
  // On extrait juste le mot sans l'icône s'il y en a une dans la trad, ou on l'utilise
  const texteDark = t.mode_dark.includes("Mode")
    ? t.mode_dark.replace("Mode", "").trim()
    : t.mode_dark;
  const texteLight = t.mode_light.includes("Mode")
    ? t.mode_light.replace("Mode", "").trim()
    : t.mode_light;

  if (modeEstSombre) {
    bouton.textContent = `☀️ ${texteLight}`;
  } else {
    bouton.textContent = `🌙 ${texteDark}`;
  }
};

bouton.addEventListener("click", function () {
  if (modeEstSombre) {
    baliseStyle.textContent = "";
    modeEstSombre = false;
  } else {
    baliseStyle.textContent = stylesDark;
    modeEstSombre = true;
  }
  // On rafraîchit le texte et le style du bouton après le clic
  window.updateModeButton();

  if (!modeEstSombre) {
    bouton.style.background = "var(--white)";
    bouton.style.color = "var(--amber)";
  } else {
    bouton.style.background = "var(--ink)";
    bouton.style.color = "var(--amber-mid)";
  }
});
