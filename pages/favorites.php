<?php
// =========================================================================
require_once __DIR__ . '/../core/auth_middelware.php';
// =========================================================================
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}


$current_user_id = $_SESSION['user']['id'];


// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=kitab;port=3307;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur BDD : ' . $e->getMessage());
}

// Requête pour récupérer les livres favoris réels de cet utilisateur
$query = $bdd->prepare("
    SELECT b.* FROM books b 
    INNER JOIN favorites f ON b.id = f.book_id 
    WHERE f.user_id = ?
    ORDER BY f.id DESC
");
$query->execute([$current_user_id]);
$favBooks = $query->fetchAll(PDO::FETCH_ASSOC);

// =========================================================================
// 2. CALCUL DYNAMIQUE DES COMPTEURS (STATS)
// =========================================================================
$totalFavorites = count($favBooks);
$totalValue = 0;
$exchangeCount = 0;
$distinctGenres = [];

foreach ($favBooks as $b) {
    // Calcul de la valeur totale (ex: "30dt" ou "30" -> extrait le nombre)
    $priceValue = floatval(preg_replace('/[^\d.]/', '', $b['prix']));
    $totalValue += $priceValue;

    // Compte des livres destinés à l'échange
    if (isset($b['for_exchange']) && ($b['for_exchange'] == 1 || strtolower($b['for_exchange']) === 'exchange' || strtolower($b['for_exchange']) === 'for exchange')) {
        $exchangeCount++;
    }

    // Extraction des genres uniques
    if (!empty($b['genre'])) {
        $distinctGenres[strtolower(trim($b['genre']))] = true;
    }
}
$genresCount = count($distinctGenres);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Favorites - KITAB</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&family=Amiri&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="../assets/css/favorites.css" />
  </head>

  <body>
    <nav id="mainNav">
      <a href="#" class="logo">KITAB<span class="text_arb">كتاب</span></a>
      <ul class="nav-links">
        <li>
          <a href="marketplace.php" id="nav_marketplace" ><span class="material-icons">local_mall</span> Marketplace</a>
        </li>
        <li>
          <a href="messages.php" id="nav_messages"><span class="material-icons">chat_bubble</span> Messages</a>
        </li>
        <li>
          <a href="codeHTML.html" id="nav_exchanges"><span class="material-icons">swap_horiz</span> Exchanges</a>
        </li>
        <li>
          <a href="favorites.php" id="nav_favorites" class="active"><span class="material-icons">favorite</span> Favorites</a>
        </li>
        <li>
          <a href="reading-rooms.php" id="nav_reading_rooms"><span class="material-icons">import_contacts</span> Reading Rooms</a>
        </li>
      </ul>

      <div class="nav-right">
        <a href="profile.php" id="nav_profile"><span class="material-icons">account_circle</span> Profile</a>
        <a href="logout.html" id="nav_logout"><span class="material-icons">logout</span>Log out</a>

        <div class="lang-switcher-nav">
          <button class="lang-btn" id="btn-en">EN</button>
          <button class="lang-btn" id="btn-fr">FR</button>
          <button class="lang-btn" id="btn-ar">AR</button>
        </div>
      </div>
    </nav>

    <div class="page-wrapper">
      <div class="page-header">
        <h1 id="fav_title">My Favorites</h1>
        <h4 id="fav_subtitle">Your curated collection of beloved books</h4>
      </div>

      <div class="page-body">
        
        <div class="stats">
          <div class="card">
            <div>
              <p id="stat_total">Total</p>
              <h2><?= $totalFavorites ?></h2>
            </div>
            <img src="../.vscode/fav.jpg" />
          </div>
          <div class="card">
            <div>
              <p id="stat_value">Value</p>
              <h2><?= $totalValue ?>dt</h2>
            </div>
            <img src="../.vscode/2.jpg" />
          </div>
          <div class="card">
            <div>
              <p id="stat_exchange">Exchange</p>
              <h2><?= $exchangeCount ?></h2>
            </div>
            <img src="../.vscode/3.jpg" />
          </div>
          <div class="card">
            <div>
              <p id="stat_genres">Genres</p>
              <h2><?= $genresCount ?></h2>
            </div>
            <img src="../.vscode/4.jpg" />
          </div>
        </div>

        <div class="favorites-container">
          <?php if (!empty($favBooks)): ?>
            <?php foreach ($favBooks as $index => $book): 
                $num = $index + 1; 
                // Correction : Utilisation du champ 'condition' défini dans ton script SQL
                $bookCondition = $book['condition'] ?? 'good';
            ?>
              
              <div class="favorite-card" id="book-<?= $book['id'] ?>">
                <div class="image-container">
                  <img src="<?= (strpos($book['image'], 'http') === 0) ? $book['image'] : '../uploads/' . $book['image'] ?>" alt="<?= htmlspecialchars($book['titre']) ?>" />
                  
                  <div class="condition <?= htmlspecialchars($bookCondition) ?>" id="cond_<?= strtolower($bookCondition) ?>_<?= $num ?>">
                    <?= ucfirst(htmlspecialchars($bookCondition)) ?>
                  </div>
                  
                  <div class="fav-icon-badge favorite-toggle-btn active" data-book-id="<?= $book['id'] ?>" data-page-favoris="true" style="cursor: pointer;">
                    <i class="bi bi-heart-fill" style="color: red;"></i>
                  </div>
                  
                  <?php if (isset($book['for_exchange']) && ($book['for_exchange'] == 1 || strtolower($book['for_exchange']) === 'exchange')): ?>
                    <div class="exchange" id="type_exchange_<?= $num ?>">Exchange</div>
                  <?php endif; ?>
                </div>

                <div class="card-body">
                  <div class="book-main">
                    <div class="book-left">
                      <h3><?= htmlspecialchars($book['titre']) ?></h3>
                      <p><?= htmlspecialchars($book['auteur'] ?? 'Unknown Author') ?></p>
                    </div>
                    <div class="book-right">
                      <div class="price"><?= floatval($book['prix']) ?>dt</div>
                    </div>
                  </div>

                  <div class="user-type">
                    <div class="user">
                      <img src="user1.jpg" alt="user" />
                      <span>Owner #<?= $book['user_id'] ?></span>
                    </div>
                    <span class="genre" id="genre_<?= strtolower($book['genre'] ?? 'general') ?>"><?= htmlspecialchars($book['genre'] ?? 'General') ?></span>
                  </div>

                  <div class="card-buttons">
                    <a href="details.php?id=<?= $book['id'] ?>" class="details" id="btn_details_<?= $num ?>"><i class="bi bi-book"></i> Details</a>
                    <a href="chat.php?id=<?= $book['user_id'] ?>" class="chat" id="btn_chat_<?= $num ?>"><i class="bi bi-chat-left"></i> Chat</a>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>
            <?php else: ?>
            <div class="empty-favorites-box">
              <div class="empty-icon">
                <i class="bi bi-heartbreak"></i>
              </div>
              <h3 id="empty_fav_title">Your list is empty</h3>
              <p id="empty_fav_text">You haven't added any books to your favorites yet.</p>
              <a href="marketplace.php" class="explore-btn" id="empty_fav_btn">
                <span class="material-icons">local_mall</span> Explore Marketplace
              </a>
            </div>
          <?php endif; ?>
        </div>

      </div>
    </div>

    <script src="../assets/js/notifications.js"></script>
    <script src="../assets/js/traduction.js"></script>
    <script src="../assets/js/RSVP.js"></script>
    <script src="../assets/js/join.js"></script>
    <script src="../assets/js/mode.js"></script>
    <script src="../assets/js/fontsize.js"></script>
    <script src="../assets/js/fullscreen.js"></script>
    <script src="../assets/js/ambiance.js"></script>
    
    <script src="../assets/js/favorites-toggle.js"></script>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const btnEn = document.getElementById("btn-en");
        const btnFr = document.getElementById("btn-fr");
        const btnAr = document.getElementById("btn-ar");

        if (typeof window.setLang === "function" && btnEn && btnFr && btnAr) {
          btnEn.addEventListener("click", () => window.setLang("en"));
          btnFr.addEventListener("click", () => window.setLang("fr"));
          btnAr.addEventListener("click", () => window.setLang("ar"));

          const savedLang = localStorage.getItem("kitabi_lang") || "en";
          window.setLang(savedLang);
        }
      });
    </script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const favBtns = document.querySelectorAll('.favorite-toggle-btn');

    favBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const bookId = this.getAttribute('data-book-id');
            const card = document.getElementById('book-' + bookId);

            fetch('/projet_web/KITAB/config/models/ajax/toggle_favorite.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'book_id=' + encodeURIComponent(bookId)
            })
            .then(response => response.json())
            .then(data => {
    if (data.success && data.action === 'removed') {
        // Supprime la carte visuellement
        card.remove();

// Mettre à jour les stats
const remainingCards = document.querySelectorAll('.favorite-card');

// Total
document.querySelector('.stats .card:nth-child(1) h2').textContent = remainingCards.length;

// Valeur totale
let totalVal = 0;
remainingCards.forEach(c => {
    const priceText = c.querySelector('.price').textContent;
    totalVal += parseFloat(priceText);
});
document.querySelector('.stats .card:nth-child(2) h2').textContent = totalVal.toFixed(1) + 'dt';

// Exchange
let exchangeCount = 0;
remainingCards.forEach(c => {
    if (c.querySelector('.exchange')) exchangeCount++;
});
document.querySelector('.stats .card:nth-child(3) h2').textContent = exchangeCount;

// Genres
let genres = [];
remainingCards.forEach(c => {
    const genre = c.querySelector('.genre').textContent.trim().toLowerCase();
    if (!genres.includes(genre)) genres.push(genre);
});
document.querySelector('.stats .card:nth-child(4) h2').textContent = genres.length;

        // Vérifie s'il reste des cartes
        const remaining = document.querySelectorAll('.favorite-card');
        if (remaining.length === 0) {
            document.querySelector('.favorites-container').innerHTML = `
                <div class="empty-favorites-box">
                    <div class="empty-icon">
                        <i class="bi bi-heartbreak"></i>
                    </div>
                    <h3 id="empty_fav_title">Your list is empty</h3>
                    <p id="empty_fav_text">You haven't added any books to your favorites yet.</p>
                    <a href="marketplace.php" class="explore-btn" id="empty_fav_btn">
                        <span class="material-icons">local_mall</span> Explore Marketplace
                    </a>
                </div>
            `;
        }
    }
})
            .catch(error => {
                console.error('Erreur:', error);
            });
        });
    });
});
</script>
  </body>
</html>