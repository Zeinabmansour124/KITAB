const navTranslations = {
  en: {
    nav_marketplace:
      '<span class="material-icons">local_mall</span> Marketplace',
    nav_messages: '<span class="material-icons">chat_bubble</span> Messages',
    nav_exchanges: '<span class="material-icons">swap_horiz</span> Exchanges',
    nav_favorites: '<span class="material-icons">favorite</span> Favorites',
    nav_reading_rooms:
      '<span class="material-icons">import_contacts</span> Reading Rooms',
    nav_profile: '<span class="material-icons">account_circle</span> Profile',
    nav_logout: '<span class="material-icons">logout</span> Log out',
  },
  fr: {
    nav_marketplace: '<span class="material-icons">local_mall</span> Marché',
    nav_messages: '<span class="material-icons">chat_bubble</span> Messages',
    nav_exchanges: '<span class="material-icons">swap_horiz</span> Échanges',
    nav_favorites: '<span class="material-icons">favorite</span> Favoris',
    nav_reading_rooms:
      '<span class="material-icons">import_contacts</span> Salons',
    nav_profile: '<span class="material-icons">account_circle</span> Profil',
    nav_logout: '<span class="material-icons">logout</span> Déconnexion',
  },
  ar: {
    nav_marketplace: '<span class="material-icons">local_mall</span> السوق',
    nav_messages: '<span class="material-icons">chat_bubble</span> الرسائل',
    nav_exchanges: '<span class="material-icons">swap_horiz</span> التبادلات',
    nav_favorites: '<span class="material-icons">favorite</span> المفضلة',
    nav_reading_rooms:
      '<span class="material-icons">import_contacts</span> غرف القراءة',
    nav_profile:
      '<span class="material-icons">account_circle</span> الملف الشخصي',
    nav_logout: '<span class="material-icons">logout</span> خروج',
  },
};

// Fonction utilitaire : met à jour un élément seulement s'il existe
function setEl(id, html, isHTML = true) {
  const el = document.getElementById(id);
  if (!el) return;
  isHTML ? (el.innerHTML = html) : (el.textContent = html);
}

window.setLang = function (lang) {
  if (!navTranslations[lang]) return;
  const t = navTranslations[lang];

  // ===== NAVBAR (commune à toutes les pages) =====
  Object.entries(t).forEach(([id, val]) => setEl(id, val));

  // ===== TRADUCTIONS SPÉCIFIQUES À LA PAGE =====
  // Chaque page peut définir window.pageTranslations avec ses propres IDs
  if (window.pageTranslations && window.pageTranslations[lang]) {
    const pt = window.pageTranslations[lang];
    Object.entries(pt).forEach(([id, val]) => {
      const el = document.getElementById(id);
      if (!el) return;
      // Si la valeur contient du HTML, innerHTML sinon textContent
      id.endsWith("_html") ? (el.innerHTML = val) : (el.textContent = val);
    });

    // Placeholders (champs input/textarea)
    if (pt._placeholders) {
      Object.entries(pt._placeholders).forEach(([id, val]) => {
        const el = document.getElementById(id);
        if (el) el.placeholder = val;
      });
    }

    // QuerySelectorAll (boutons multiples)
    if (pt._selectors) {
      Object.entries(pt._selectors).forEach(([selector, val]) => {
        document
          .querySelectorAll(selector)
          .forEach((el) => (el.textContent = val));
      });
    }
  }

  // ===== RTL =====
  document.body.classList.toggle("rtl", lang === "ar");
  document.documentElement.setAttribute("dir", lang === "ar" ? "rtl" : "ltr");

  // ===== BOUTON ACTIF =====
  document
    .querySelectorAll(".lang-btn")
    .forEach((b) => b.classList.remove("lang-active"));
  const btn = document.getElementById("btn-" + lang);
  if (btn) btn.classList.add("lang-active");

  localStorage.setItem("kitabi_lang", lang);
};

// ===== INIT =====
document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("btn-en")
    ?.addEventListener("click", () => window.setLang("en"));
  document
    .getElementById("btn-fr")
    ?.addEventListener("click", () => window.setLang("fr"));
  document
    .getElementById("btn-ar")
    ?.addEventListener("click", () => window.setLang("ar"));
  window.setLang(localStorage.getItem("kitabi_lang") || "fr");
});
