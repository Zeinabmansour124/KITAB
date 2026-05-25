<nav id="mainNav">
      <a href="#" class="logo">KITAB<span class="text_arb">كتاب</span></a>
      <ul class="nav-links">
        <li>
          <a href="/projet_web/KITAB/pages/marketplace.php" id="nav_marketplace" class="active"
            ><span class="material-icons">local_mall</span> Marketplace</a
          >
        </li>
        <li>
          <a href="/projet_web/KITAB/pages/messages.php" id="nav_messages"
            ><span class="material-icons">chat_bubble</span> Messages</a
          >
        </li>
        <li>
          <a href="/projet_web/KITAB/pages/exchangePage.php" id="nav_exchanges"
            ><span class="material-icons">swap_horiz</span> Exchanges</a
          >
        </li>
        <li>
          <a href="/projet_web/KITAB/pages/favorites.php" id="nav_favorites"
            ><span class="material-icons">favorite</span> Favorites</a
          >
        </li>
        <li>
          <a href="/projet_web/KITAB/pages/reading-rooms.php" id="nav_reading_rooms"
            ><span class="material-icons">import_contacts</span> Reading Rooms</a
          >
        </li>
      </ul>

    <div class="nav-right">

        <?php if(isset($_SESSION['user'])): ?>

            <a href="/projet_web/KITAB/pages/profile.php" id="nav_profile">
                <span class="material-icons">account_circle</span>
                Profile
            </a>

            <a href="/projet_web/KITAB/includes/controllers/index.php?page=logout" id="nav_logout">
                <span class="material-icons">logout</span>
                Log out
            </a>

        <?php else: ?>

            <a href="/projet_web/KITAB/includes/controllers/index.php?page=login" id="nav_login">
                <span class="material-icons">login</span>
                Sign In
            </a>

            <a href="/projet_web/KITAB/includes/controllers/index.php?page=register" id="nav_register">
                <span class="material-icons">person_add</span>
                Sign Up
            </a>

        <?php endif; ?>

        <div class="lang-switcher-nav">
            <button class="lang-btn" id="btn-en">EN</button>
            <button class="lang-btn" id="btn-fr">FR</button>
            <button class="lang-btn" id="btn-ar">AR</button>
        </div>

    </div>

</nav>  


<script src="/projet_web/KITAB/assets/js/mode.js"></script>


<script src="/projet_web/KITAB/assets/js/traduction.js"></script>