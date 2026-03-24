
const TAB_CONFIG = [
  { id: 'tab_discover',  filter: 'all' },
  { id: 'tab_live',      filter: 'live' },
  { id: 'tab_scheduled', filter: 'scheduled' },
  { id: 'tab_myrooms',   filter: 'myrooms' },
];


const MY_ROOMS_HOSTS = ['Sarah Johnson', 'Emily Davis'];


function injectTabStyles() {
  const style = document.createElement('style');
  style.textContent = `
    .room-card.tab-hidden { display: none; }
    .room-card.tab-visible { display: block; }
    .nav-tab.active { font-weight: bold; }
    #tab-empty-msg { display: none; text-align: center; margin: 20px 0; }
    #tab-empty-msg.show { display: block; }
  `;
  document.head.appendChild(style);
}


function createEmptyMessage() {
  if (document.getElementById('tab-empty-msg')) return;

  const msg = document.createElement('div');
  msg.id = 'tab-empty-msg';
  msg.innerHTML = `
    <h3>Aucune room disponible</h3>
    <p>Il n'y a pas de session dans cette catégorie pour le moment.</p>
  `;
  document.body.appendChild(msg);
}

function getCardCategory(card) {
  const badge = card.querySelector('.badge');
  if (!badge) return 'unknown';
  if (badge.classList.contains('live')) return 'live';
  if (badge.classList.contains('scheduled')) return 'scheduled';
  return 'unknown';
}



function filterCards(filter) {
  const allCards = document.querySelectorAll('.room-card');
  const emptyMsg = document.getElementById('tab-empty-msg');
  let found = false;

  allCards.forEach(card => {
    let show = false;

    if (filter === 'all') show = true;
    else if (filter === 'live') show = getCardCategory(card) === 'live';
    else if (filter === 'scheduled') show = getCardCategory(card) === 'scheduled';
    else if (filter === 'myrooms') show = isMyRoom(card);

    if (show) {
      card.classList.remove('tab-hidden');
      card.classList.add('tab-visible');
      found = true;
    } else {
      card.classList.remove('tab-visible');
      card.classList.add('tab-hidden');
    }
  });

  
  if (!found) emptyMsg.classList.add('show');
  else emptyMsg.classList.remove('show');
}

function handleTabClick(e, tabConfig) {
  e.preventDefault();
  document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
  const tabEl = document.getElementById(tabConfig.id);
  if (tabEl) tabEl.classList.add('active');
  filterCards(tabConfig.filter);
}

document.addEventListener('DOMContentLoaded', function () {
  injectTabStyles();
  createEmptyMessage();

  TAB_CONFIG.forEach(tab => {
    const tabEl = document.getElementById(tab.id);
    if (tabEl) tabEl.addEventListener('click', e => handleTabClick(e, tab));
  });

  
  filterCards('all');
});