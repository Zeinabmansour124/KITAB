const bouton = document.createElement("button");
bouton.id = "mode-toggle-btn";
document.body.appendChild(bouton);

bouton.style.cssText = `
  position: fixed; bottom: 28px; right: 28px; z-index: 9999;
  padding: 10px 20px; border-radius: 50px;
  border: 1px solid var(--border);
  background: var(--white); color: var(--amber);
  font-family: 'DM Sans', sans-serif; font-size: 14px;
  font-weight: 700; cursor: pointer;
  box-shadow: 0 4px 15px rgba(26,18,8,.15);
  transition: all 0.25s ease;
`;

const stylesDark = `
  body, .content, .page-body, .page-wrapper { background-color: #16110b !important; color: #f5f0e8 !important; }
  #mainNav                    { background-color: #12100a !important; }
  .book-card, .room-card, .stat-card { background-color: #241a11 !important; border-color: #3a2a1b !important; color: #f5f0e8 !important; }
  .search-area, .bloc1        { background-color: #1a1208 !important; }
  .nav-search, .selectbar     { background-color: rgba(255,255,255,.08) !important; color: #f9efd0 !important; }
  .book-card .nombook         { color: #fffdf8 !important; }
  .book-card .card-body p     { color: #d4c8b8 !important; }
  .book-card .person          { color: #d4c8b8 !important; }
  .book-card .booktype        { color: #f9c85b !important; background-color: rgba(200,134,10,0.2) !important; }
  .book-card .price           { color: #6fcf8a !important; }
  .book-card .details         { color: #fffdf8 !important; border-color: #666 !important; display: inline-block !important; }
  .book-card .chat            { color: #fffdf8 !important; background-color: #3a2a1b !important; display: inline-block !important; }
  .tag                        { background: rgba(255,255,255,.05) !important; color: #f9c85b !important; }
  .progress-bar-bg            { background: #3a2a1b !important; }
  #bookCount                  { color: #d4c8b8 !important; }
  .promo-band                 { background: #0a0806 !important; }
`;
const baliseStyle = document.createElement("style");
baliseStyle.id = "dark-mode-style";
document.head.appendChild(baliseStyle);

let modeEstSombre = localStorage.getItem("kitabi_theme") === "dark";

function applyTheme() {
  if (modeEstSombre) {
    baliseStyle.textContent = stylesDark;
    bouton.textContent = "☀️ Light";
    bouton.style.background = "var(--ink)";
    bouton.style.color = "var(--amber-mid)";
    localStorage.setItem("kitabi_theme", "dark");
  } else {
    baliseStyle.textContent = "";
    bouton.textContent = "🌙 Dark";
    bouton.style.background = "var(--white)";
    bouton.style.color = "var(--amber)";
    localStorage.setItem("kitabi_theme", "light");
  }
}

// Applique au chargement
applyTheme();

bouton.addEventListener("click", function () {
  modeEstSombre = !modeEstSombre;
  applyTheme();
});

bouton.addEventListener("mouseenter", () => {
  bouton.style.background = "var(--amber)";
  bouton.style.color = "white";
  bouton.style.transform = "translateY(-2px)";
});
bouton.addEventListener("mouseleave", () => {
  applyTheme();
  bouton.style.transform = "translateY(0)";
});
