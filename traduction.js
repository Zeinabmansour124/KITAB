

function setLang(lang) {

  
  document.getElementById('tagline').textContent           = { en:"Read.Share.Connect",          fr:"Lire.Partager.Connecter",              ar:"اقرأ.شارك.تواصل"           }[lang];
  document.getElementById('nav_marketplace').textContent   = { en:"Marketplace",                 fr:"Marché",                               ar:"السوق"                     }[lang];
  document.getElementById('nav_messages').textContent      = { en:"Messages",                    fr:"Messages",                             ar:"الرسائل"                   }[lang];
  document.getElementById('nav_exchanges').textContent     = { en:"Exchanges",                   fr:"Échanges",                             ar:"التبادلات"                 }[lang];
  document.getElementById('nav_favorites').textContent     = { en:"Favorites",                   fr:"Favoris",                              ar:"المفضلة"                   }[lang];
  document.getElementById('nav_reading_rooms').textContent = { en:"Reading Rooms",               fr:"Salons de lecture",                    ar:"غرف القراءة"               }[lang];
  document.getElementById('nav_dashboard').textContent     = { en:"Dashboard",                   fr:"Tableau de bord",                      ar:"لوحة التحكم"               }[lang];
  document.getElementById('nav_leaderboard').textContent   = { en:"LeaderBoard",                 fr:"Classement",                           ar:"المتصدرون"                 }[lang];
  document.getElementById('nav_profile').textContent       = { en:"Profile",                     fr:"Profil",                               ar:"الملف الشخصي"              }[lang];
  document.getElementById('nav_notifications').textContent = { en:"Notifications",               fr:"Notifications",                        ar:"الإشعارات"                 }[lang];
  document.getElementById('nav_settings').textContent      = { en:"Settings",                    fr:"Paramètres",                           ar:"الإعدادات"                 }[lang];

  
  document.getElementById('page_title').textContent        = { en:"Reading Rooms",               fr:"Salons de lecture",                    ar:"غرف القراءة"               }[lang];
  document.getElementById('page_subtitle').textContent     = { en:"Read together with the community", fr:"Lisez ensemble avec la communauté", ar:"اقرأ مع المجتمع معاً"    }[lang];
  document.getElementById('create_room').textContent       = { en:"+ Create Room",               fr:"+ Créer un salon",                     ar:"+ إنشاء غرفة"              }[lang];

  
  document.getElementById('stat_live').textContent         = { en:"Live Now",                    fr:"En direct",                            ar:"مباشر الآن"                }[lang];
  document.getElementById('stat_scheduled').textContent    = { en:"Scheduled",                   fr:"Planifiés",                            ar:"مجدولة"                    }[lang];
  document.getElementById('stat_myrooms').textContent      = { en:"My Rooms",                    fr:"Mes salons",                           ar:"غرفي"                      }[lang];
  document.getElementById('stat_readers').textContent      = { en:"Total Readers",               fr:"Lecteurs totaux",                      ar:"إجمالي القراء"             }[lang];

  
  document.getElementById('search_bar').placeholder        = { en:"🔍  Search reading rooms by book title or author...", fr:"🔍  Rechercher par titre de livre ou auteur...", ar:"🔍  ابحث بعنوان الكتاب أو اسم المؤلف..." }[lang];

  
  document.getElementById('tab_discover').textContent      = { en:"Discover",                    fr:"Découvrir",                            ar:"اكتشاف"                    }[lang];
  document.getElementById('tab_live').textContent          = { en:"Live now",                    fr:"En direct",                            ar:"مباشر"                     }[lang];
  document.getElementById('tab_scheduled').textContent     = { en:"Scheduled",                   fr:"Planifiés",                            ar:"مجدولة"                    }[lang];
  document.getElementById('tab_myrooms').textContent       = { en:"My rooms",                    fr:"Mes salons",                           ar:"غرفي"                      }[lang];

  document.getElementById('section_live').textContent      = { en:"Live Sessions",               fr:"Sessions en direct",                   ar:"جلسات مباشرة"              }[lang];
  document.getElementById('section_upcoming').textContent  = { en:"Upcoming Sessions",           fr:"Sessions à venir",                     ar:"الجلسات القادمة"           }[lang];

  
  document.getElementById('no_rooms').textContent          = { en:"No rooms found",              fr:"Aucun salon trouvé",                   ar:"لم يتم العثور على غرف"     }[lang];
  document.getElementById('no_rooms_sub').textContent      = { en:"No reading room matches",     fr:"Aucun salon ne correspond à",          ar:"لا توجد غرفة قراءة تطابق" }[lang];



  document.querySelectorAll('.btn_join').forEach(function(el) {
    el.textContent = { en:"Join Now", fr:"Rejoindre", ar:"انضم الآن" }[lang];
  });

  document.querySelectorAll('.btn_rsvp').forEach(function(el) {
    el.textContent = { en:"RSVP", fr:"Réserver", ar:"احجز مقعداً" }[lang];
  });

  document.querySelectorAll('.host_role_text').forEach(function(el) {
    el.textContent = { en:"Host", fr:"Hôte", ar:"مضيف" }[lang];
  });


  if (lang === 'ar') {
    document.body.classList.add('rtl');
    document.documentElement.setAttribute('dir', 'rtl');
  } else {
    document.body.classList.remove('rtl');
    document.documentElement.removeAttribute('dir');
  }

  document.querySelectorAll('.lang-btn').forEach(function(btn) {
    btn.classList.remove('lang-active');
  });
  event.target.classList.add('lang-active');

  
  try { localStorage.setItem('kitabi_lang', lang); } catch(e) {}

}