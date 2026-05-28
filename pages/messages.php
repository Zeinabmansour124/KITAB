<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Messages - KITAB</title>

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=DM+Sans:wght@300;400;500;600&family=Amiri:ital,wght@0,400;0,700;1,400&display=swap"
    rel="stylesheet"
  />

  <link
    href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet"
  />

  <!-- CSS -->
  <link rel="stylesheet" href="../assets/css/reading-room.css" />
  <link rel="stylesheet" href="../assets/css/messages.css" />
</head>

<body>

<!-- NAVBAR -->
<nav id="mainNav">

  <a href="#" class="logo">
    KITAB<span class="text_arb">كتاب</span>
  </a>

  <ul class="nav-links">

    <li>
      <a href="/projet_web/KITAB/pages/marketplace.php" id="nav_marketplace">
        <span class="material-icons">local_mall</span>
        Marketplace
      </a>
    </li>

    <li>
      <a href="/projet_web/KITAB/pages/messages.php"
         id="nav_messages"
         class="active">
        <span class="material-icons">chat_bubble</span>
        Messages
      </a>
    </li>

    <li>
      <a href="/projet_web/KITAB/pages/exchangePage.php" id="nav_exchanges">
        <span class="material-icons">swap_horiz</span>
        Exchanges
      </a>
    </li>

    <li>
      <a href="/projet_web/KITAB/pages/favorites.php" id="nav_favorites">
        <span class="material-icons">favorite</span>
        Favorites
      </a>
    </li>

    <li>
      <a href="/projet_web/KITAB/pages/reading-rooms.php" id="nav_reading_rooms">
        <span class="material-icons">import_contacts</span>
        Reading Rooms
      </a>
    </li>

  </ul>

  <div class="nav-right">

    <a href="#" id="nav_profile">
      <span class="material-icons">account_circle</span>
      Profile
    </a>

    <a href="#" id="nav_logout">
      <span class="material-icons">logout</span>
      Log out
    </a>

    <div class="lang-switcher-nav">
      <button class="lang-btn" id="btn-en">EN</button>
      <button class="lang-btn" id="btn-fr">FR</button>
      <button class="lang-btn" id="btn-ar">AR</button>
    </div>

  </div>

</nav>

<!-- PAGE -->
<div class="page-wrapper">

  <!-- HEADER -->
  <div class="page-header">

    <div class="page-header-text">
      <h1 id="page_title">Messages</h1>
      <h4 id="page_subtitle">Chat with your contacts</h4>
    </div>

    <a href="#" class="create-room-btn" id="new_message">
      + New Message
    </a>

  </div>

  <!-- BODY -->
  <div class="page-body">

    <!-- SEARCH -->
    <div class="search-area">
      <input
        type="text"
        class="search-bar"
        id="search_bar"
        placeholder="🔍 Search messages or contacts…"
      />
    </div>

    <!-- MESSAGES -->
    <div class="messages-container">

      <!-- Alice -->
      <div class="message-card">

        <img
          src="../assets/images/messeges1.jpg"
          alt="Alice"
          class="contact-avatar"
        />

        <div class="message-info">

          <div class="message-header">
            <h3 class="contact-name">Alice Brown</h3>
            <span class="message-time">10:24 AM</span>
          </div>

          <p class="message-snippet">
            Hey! Are we meeting today for the book discussion?
          </p>

        </div>

      </div>

      <!-- David -->
      <div class="message-card">

        <img
          src="../assets/images/messeges2.jpg"
          alt="David"
          class="contact-avatar"
        />

        <div class="message-info">

          <div class="message-header">
            <h3 class="contact-name">David Smith</h3>
            <span class="message-time">Yesterday</span>
          </div>

          <p class="message-snippet">
            I finished reading "The Great Gatsby". Amazing book!
          </p>

        </div>

      </div>

      <!-- Emily -->
      <div class="message-card">

        <img
          src="../assets/images/messeges3.jpg"
          alt="Emily"
          class="contact-avatar"
        />

        <div class="message-info">

          <div class="message-header">
            <h3 class="contact-name">Emily Davis</h3>
            <span class="message-time">2 days ago</span>
          </div>

          <p class="message-snippet">
            Let's schedule the next reading room session.
          </p>

        </div>

      </div>

    </div>

    <!-- EMPTY -->
    <div id="no-messages" style="display:none;">

      <h3>No messages found</h3>

      <p>
        Start a new conversation by clicking
        <strong>+ New Message</strong>.
      </p>

    </div>

  </div>

</div>

<!-- JS -->
<script>

const searchBar = document.querySelector("#search_bar");

searchBar.addEventListener("input", function () {

  const query = this.value.trim().toLowerCase();

  const cards = document.querySelectorAll(".message-card");

  let found = 0;

  cards.forEach((card) => {

    const name = card
      .querySelector(".contact-name")
      .textContent.toLowerCase();

    const snippet = card
      .querySelector(".message-snippet")
      .textContent.toLowerCase();

    if (name.includes(query) || snippet.includes(query)) {

      card.style.display = "flex";
      found++;

    } else {

      card.style.display = "none";

    }

  });

  document.getElementById("no-messages").style.display =
    found === 0 && query !== ""
      ? "block"
      : "none";

});

</script>

</body>
</html>