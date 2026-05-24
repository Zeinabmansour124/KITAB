window.setLang = function (lang) {
  console.log("Changement de langue vers:", lang);

  // Traductions des textes
  const translations = {
    en: {
      marketplace: '<span class="material-icons">local_mall</span> Marketplace',
      messages: '<span class="material-icons">chat_bubble</span> Messages',
      exchanges: '<span class="material-icons">swap_horiz</span> Exchanges',
      favorites: '<span class="material-icons">favorite</span> Favorites',
      reading_rooms:
        '<span class="material-icons">import_contacts</span> Reading Rooms',
      dashboard: '<span class="material-icons">dashboard</span> Dashboard',
      leaderboard:
        '<span class="material-icons">emoji_events</span> LeaderBoard',
      profile: '<span class="material-icons">account_circle</span> Profile',
      title: "Reading Rooms",
      subtitle: "Read together with the community",
      create: "+ Create Room",
      live_stat: "Live Now",
      sched_stat: "Scheduled",
      my_stat: "My Rooms",
      total_stat: "Total Readers",
      search_placeholder: "🔍 Search reading rooms by book title or author...",
      btn_join: "Join Now",
      btn_rsvp: "RSVP",
      host: "Host",
      fav_title: "My Favorites",
      fav_subtitle: "Your curated collection of beloved books",
      stat_total: "Total",
      stat_value: "Value",
      stat_exchange: "Exchange",
      stat_genres: "Genres",
      genre_classic: "Classic",
      genre_scifi: "Sci-Fi",
      genre_fantasy: "Fantasy",
      cond_fair_1: "Fair",
      cond_good_2: "Good",
      cond_acceptable_3: "Acceptable",
      type_exchange_1: "Exchange",
      type_exchange_2: "Exchange",
      type_exchange_3: "Exchange",
      btn_details_1: "Details",
      btn_details_2: "Details",
      btn_details_3: "Details",
      btn_chat_1: "Chat",
      btn_chat_2: "Chat",
      btn_chat_3: "Chat",
      mode_dark: "Dark Mode",
      mode_light: "Light Mode",
      screen_full: "Fullscreen",
      screen_exit: "Exit Fullscreen",
      // --- Nouvelles clés : Bloc Favoris Vide ---
      empty_fav_title: "Your list is empty",
      empty_fav_text: "You haven't added any books to your favorites yet.",
      empty_fav_btn: "Explore Marketplace",
    },
    fr: {
      marketplace: '<span class="material-icons">local_mall</span> Marché',
      messages: '<span class="material-icons">chat_bubble</span> Messages',
      exchanges: '<span class="material-icons">swap_horiz</span> Échanges',
      favorites: '<span class="material-icons">favorite</span> Favoris',
      reading_rooms:
        '<span class="material-icons">import_contacts</span> Salons',
      dashboard:
        '<span class="material-icons">dashboard</span> Tableau de bord',
      leaderboard:
        '<span class="material-icons">emoji_events</span> Classement',
      profile: '<span class="material-icons">account_circle</span> Profil',
      title: "Salons de lecture",
      subtitle: "Lisez ensemble avec la communauté",
      create: "+ Créer un salon",
      live_stat: "En direct",
      sched_stat: "Planifiés",
      my_stat: "Mes salons",
      total_stat: "Lecteurs totaux",
      search_placeholder: "🔍 Rechercher par titre ou auteur...",
      btn_join: "Rejoindre",
      btn_rsvp: "Réserver",
      host: "Hôte",
      fav_title: "Mes Favoris",
      fav_subtitle: "Votre collection de livres adorés",
      stat_total: "Total",
      stat_value: "Valeur",
      stat_exchange: "Échange",
      stat_genres: "Genres",
      genre_classic: "Classique",
      genre_scifi: "Sci-Fi",
      genre_fantasy: "Fantastique",
      cond_fair_1: "Moyen",
      cond_good_2: "Bon état",
      cond_acceptable_3: "Acceptable",
      type_exchange_1: "Échange",
      type_exchange_2: "Échange",
      type_exchange_3: "Échange",
      btn_details_1: "Détails",
      btn_details_2: "Détails",
      btn_details_3: "Détails",
      btn_chat_1: "Discuter",
      btn_chat_2: "Discuter",
      btn_chat_3: "Discuter",
      mode_dark: "Mode Sombre",
      mode_light: "Mode Clair",
      screen_full: "Plein écran",
      screen_exit: "Quitter Plein écran",
      // --- Nouvelles clés : Bloc Favoris Vide ---
      empty_fav_title: "Votre liste est vide",
      empty_fav_text: "Vous n'avez pas encore ajouté de livres à vos favoris.",
      empty_fav_btn: "Explorer la Marketplace",
    },
    ar: {
      marketplace: '<span class="material-icons">local_mall</span> السوق',
      messages: '<span class="material-icons">chat_bubble</span> الرسائل',
      exchanges: '<span class="material-icons">swap_horiz</span> التبادلات',
      favorites: '<span class="material-icons">favorite</span> المفضلة',
      reading_rooms:
        '<span class="material-icons">import_contacts</span> غرف القراءة',
      dashboard: '<span class="material-icons">dashboard</span> لوحة التحكم',
      leaderboard: '<span class="material-icons">emoji_events</span> المتصدرون',
      profile:
        '<span class="material-icons">account_circle</span> الملف الشخصي',
      title: "غرف القراءة",
      subtitle: "اقرأ مع المجتمع معاً",
      create: "+ إنشاء غرفة",
      live_stat: "مباشر الآن",
      sched_stat: "مجدولة",
      my_stat: "غرفي",
      total_stat: "إجمالي القراء",
      search_placeholder: "🔍 ابحث بعنوان الكتاب ou اسم المؤلف...",
      btn_join: "انضم الآن",
      btn_rsvp: "احجز مقعداً",
      host: "مضيف",
      fav_title: "كتبى المفضلة",
      fav_subtitle: "مجموعتك المنسقة من الكتب المحبوبة",
      stat_total: "المجموع",
      stat_value: "القيمة",
      stat_exchange: "تبادل",
      stat_genres: "الأنواع",
      genre_classic: "كلاسيكي",
      genre_scifi: "خيال علمي",
      genre_fantasy: "خيالي",
      cond_fair_1: "مقبول",
      cond_good_2: "جيد",
      cond_acceptable_3: "صالح للقراءة",
      type_exchange_1: "تبادل",
      type_exchange_2: "تبادل",
      type_exchange_3: "تبادل",
      btn_details_1: "التفاصيل",
      btn_details_2: "التفاصيل",
      btn_details_3: "التفاصيل",
      btn_chat_1: "محادثة",
      btn_chat_2: "محادثة",
      btn_chat_3: "محادثة",
      mode_dark: "الوضع الداكن",
      mode_light: "الوضع الفاتح",
      screen_full: "ملء الشاشة",
      screen_exit: "إلغاء ملء الشاشة",
      // --- Nouvelles clés : Bloc Favoris Vide ---
      empty_fav_title: "قائمتك فارغة",
      empty_fav_text: "لم تقم بإضافة أي كتب إلى مفضلتك بعد.",
      empty_fav_btn: "تصفح المتجر",
    },
  };

  const t = translations[lang];

  // Sauvegarde globale des traductions actives pour les autres scripts
  window.currentTranslations = t;

  // Fonctions utilitaires sécurisées
  const updateHTML = (id, value) => {
    const el = document.getElementById(id);
    if (el && value) el.innerHTML = value;
  };

  const updateText = (id, value) => {
    const el = document.getElementById(id);
    if (el && value) el.textContent = value;
  };

  // --- Traduction de la Barre de Navigation ---
  updateHTML("nav_marketplace", t.marketplace);
  updateHTML("nav_messages", t.messages);
  updateHTML("nav_exchanges", t.exchanges);
  updateHTML("nav_favorites", t.favorites);
  updateHTML("nav_reading_rooms", t.reading_rooms);
  updateHTML("nav_dashboard", t.dashboard);
  updateHTML("nav_leaderboard", t.leaderboard);
  updateHTML("nav_profile", t.profile);

  // --- Traduction de la page Reading Rooms ---
  updateText("page_title", t.title);
  updateText("page_subtitle", t.subtitle);
  updateText("create_room", t.create);
  updateText("stat_live", t.live_stat);
  updateText("stat_scheduled", t.sched_stat);
  updateText("stat_myrooms", t.my_stat);
  updateText("stat_readers", t.total_stat);

  const searchBar = document.getElementById("search_bar");
  if (searchBar) searchBar.placeholder = t.search_placeholder;

  // --- Traduction de la page Favorites ---
  updateText("fav_title", t.fav_title);
  updateText("fav_subtitle", t.fav_subtitle);
  updateText("stat_total", t.stat_total);
  updateText("stat_value", t.stat_value);
  updateText("stat_exchange", t.stat_exchange);
  updateText("stat_genres", t.stat_genres);

  // Genres & Conditions
  updateText("genre_classic", t.genre_classic);
  updateText("genre_scifi", t.genre_scifi);
  updateText("genre_fantasy", t.genre_fantasy);
  updateText("cond_fair_1", t.cond_fair_1);
  updateText("cond_good_2", t.cond_good_2);
  updateText("cond_acceptable_3", t.cond_acceptable_3);
  updateText("type_exchange_1", t.type_exchange_1);
  updateText("type_exchange_2", t.type_exchange_2);
  updateText("type_exchange_3", t.type_exchange_3);

  // --- Traduction du Bloc Favoris Vide (S'il est affiché à l'écran) ---
  updateText("empty_fav_title", t.empty_fav_title);
  updateText("empty_fav_text", t.empty_fav_text);

  const emptyFavBtn = document.getElementById("empty_fav_btn");
  if (emptyFavBtn && t.empty_fav_btn) {
    emptyFavBtn.innerHTML = `<span class="material-icons">local_mall</span> ${t.empty_fav_btn}`;
  }

  // Boutons cartes Favoris
  const details1 = document.getElementById("btn_details_1");
  if (details1)
    details1.innerHTML = `<i class="bi bi-book"></i> ${t.btn_details_1}`;
  const details2 = document.getElementById("btn_details_2");
  if (details2)
    details2.innerHTML = `<i class="bi bi-book"></i> ${t.btn_details_2}`;
  const details3 = document.getElementById("btn_details_3");
  if (details3)
    details3.innerHTML = `<i class="bi bi-book"></i> ${t.btn_details_3}`;

  const chat1 = document.getElementById("btn_chat_1");
  if (chat1)
    chat1.innerHTML = `<i class="bi bi-chat-left"></i> ${t.btn_chat_1}`;
  const chat2 = document.getElementById("btn_chat_2");
  if (chat2)
    chat2.innerHTML = `<i class="bi bi-chat-left"></i> ${t.btn_chat_2}`;
  const chat3 = document.getElementById("btn_chat_3");
  if (chat3)
    chat3.innerHTML = `<i class="bi bi-chat-left"></i> ${t.btn_chat_3}`;

  // --- Boutons multiples & rôles ---
  document
    .querySelectorAll(".btn_join")
    .forEach((btn) => (btn.textContent = t.btn_join));
  document
    .querySelectorAll(".btn_rsvp")
    .forEach((btn) => (btn.textContent = t.btn_rsvp));
  document
    .querySelectorAll(".host_role_text")
    .forEach((role) => (role.textContent = t.host));

  if (document.getElementById("host_role_text_1")) {
    document.getElementById("host_role_text_1").textContent = t.host;
  }

  // --- Traduction du bouton Log out ---
  const logoutBtn = document.getElementById("nav_logout");
  if (logoutBtn) {
    logoutBtn.innerHTML = `<span class="material-icons">logout</span> ${
      lang === "fr" ? "Déconnexion" : lang === "ar" ? "تسجيل الخروج" : "Log out"
    }`;
  }

  // --- MISE À JOUR DIRECTE DES BOUTONS EXTERNES (MODE & FULLSCREEN) ---
  if (typeof window.updateModeButton === "function") {
    window.updateModeButton();
  }

  // Sécurité : si fullscreen.js n'a pas encore fini de charger son bouton au démarrage, on réessaye après 50ms
  if (typeof window.updateFullscreenButton === "function") {
    window.updateFullscreenButton();
  } else {
    setTimeout(() => {
      if (typeof window.updateFullscreenButton === "function") {
        window.updateFullscreenButton();
      }
    }, 50);
  }

  // --- Gestion de la direction (RTL / LTR) ---
  if (lang === "ar") {
    document.body.classList.add("rtl");
    document.documentElement.setAttribute("dir", "rtl");
  } else {
    document.body.classList.remove("rtl");
    document.documentElement.setAttribute("dir", "ltr");
  }

  // Gestion de la classe active sur les boutons de langues
  document
    .querySelectorAll(".lang-btn")
    .forEach((btn) => btn.classList.remove("lang-active"));
  const currentLangBtn = document.getElementById(`btn-${lang}`);
  if (currentLangBtn) currentLangBtn.classList.add("lang-active");

  localStorage.setItem("kitabi_lang", lang);
}; // Fin exacte de window.setLang
