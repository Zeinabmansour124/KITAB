window.setLang = function(lang) {
    console.log("Changement de langue vers:", lang);
    
    // Traductions des textes
    const translations = {
        en: {
            marketplace: '<span class="material-icons">local_mall</span> Marketplace',
            messages: '<span class="material-icons">chat_bubble</span> Messages',
            exchanges: '<span class="material-icons">swap_horiz</span> Exchanges',
            favorites: '<span class="material-icons">favorite</span> Favorites',
            reading_rooms: '<span class="material-icons">import_contacts</span> Reading Rooms',
            dashboard: '<span class="material-icons">dashboard</span> Dashboard',
            leaderboard: '<span class="material-icons">emoji_events</span> LeaderBoard',
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
            host: "Host"
        },
        fr: {
            marketplace: '<span class="material-icons">local_mall</span> Marché',
            messages: '<span class="material-icons">chat_bubble</span> Messages',
            exchanges: '<span class="material-icons">swap_horiz</span> Échanges',
            favorites: '<span class="material-icons">favorite</span> Favoris',
            reading_rooms: '<span class="material-icons">import_contacts</span> Salons',
            dashboard: '<span class="material-icons">dashboard</span> Tableau de bord',
            leaderboard: '<span class="material-icons">emoji_events</span> Classement',
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
            host: "Hôte"
        },
        ar: {
            marketplace: '<span class="material-icons">local_mall</span> السوق',
            messages: '<span class="material-icons">chat_bubble</span> الرسائل',
            exchanges: '<span class="material-icons">swap_horiz</span> التبادلات',
            favorites: '<span class="material-icons">favorite</span> المفضلة',
            reading_rooms: '<span class="material-icons">import_contacts</span> غرف القراءة',
            dashboard: '<span class="material-icons">dashboard</span> لوحة التحكم',
            leaderboard: '<span class="material-icons">emoji_events</span> المتصدرون',
            profile: '<span class="material-icons">account_circle</span> الملف الشخصي',
            title: "غرف القراءة",
            subtitle: "اقرأ مع المجتمع معاً",
            create: "+ إنشاء غرفة",
            live_stat: "مباشر الآن",
            sched_stat: "مجدولة",
            my_stat: "غرفي",
            total_stat: "إجمالي القراء",
            search_placeholder: "🔍 ابحث بعنوان الكتاب أو اسم المؤلف...",
            btn_join: "انضم الآن",
            btn_rsvp: "احجز مقعداً",
            host: "مضيف"
        }
    };

    const t = translations[lang];

    // Mise à jour du Menu (avec innerHTML pour garder les icônes)
    document.getElementById("nav_marketplace").innerHTML = t.marketplace;
    document.getElementById("nav_messages").innerHTML = t.messages;
    document.getElementById("nav_exchanges").innerHTML = t.exchanges;
    document.getElementById("nav_favorites").innerHTML = t.favorites;
    document.getElementById("nav_reading_rooms").innerHTML = t.reading_rooms;
    document.getElementById("nav_dashboard").innerHTML = t.dashboard;
    document.getElementById("nav_leaderboard").innerHTML = t.leaderboard;
    document.getElementById("nav_profile").innerHTML = t.profile;

    // Mise à jour de la page
    document.getElementById("page_title").textContent = t.title;
    document.getElementById("page_subtitle").textContent = t.subtitle;
    document.getElementById("create_room").textContent = t.create;

    // Stats
    document.getElementById("stat_live").textContent = t.live_stat;
    document.getElementById("stat_scheduled").textContent = t.sched_stat;
    document.getElementById("stat_myrooms").textContent = t.my_stat;
    document.getElementById("stat_readers").textContent = t.total_stat;

    // Search
    document.getElementById("search_bar").placeholder = t.search_placeholder;

    // Boutons multiples (Join, RSVP, Roles)
    document.querySelectorAll(".btn_join").forEach(btn => btn.textContent = t.btn_join);
    document.querySelectorAll(".btn_rsvp").forEach(btn => btn.textContent = t.btn_rsvp);
    document.querySelectorAll(".host_role_text").forEach(role => role.textContent = t.host);
    
    // Cas spécifique pour l'ID host_role_text_1 (le premier de votre liste)
    if(document.getElementById("host_role_text_1")) {
        document.getElementById("host_role_text_1").textContent = t.host;
    }

    // Gestion RTL et Active Button
    if (lang === "ar") {
        document.body.classList.add("rtl");
        document.documentElement.setAttribute("dir", "rtl");
    } else {
        document.body.classList.remove("rtl");
        document.documentElement.setAttribute("dir", "ltr");
    }

    document.querySelectorAll(".lang-btn").forEach(btn => btn.classList.remove("lang-active"));
    document.getElementById(`btn-${lang}`).classList.add("lang-active");

    localStorage.setItem("kitabi_lang", lang);
};