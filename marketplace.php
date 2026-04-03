<?php
// 1. On affiche les erreurs pour comprendre le problème
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. On connecte la base de données
require_once 'config/autoloader.php'; 

$bookRepo = new BookRepository();
$books = $bookRepo->findAll(); 

// TEST DE DÉBOGAGE : Enlève les "//" devant la ligne suivante pour voir si les livres existent
// var_dump($books); die(); 
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="marketPlace.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&family=Amiri&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&amp;family=DM+Sans:wght@300;400;500&amp;display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="favicon (1).ico" type="image/x-icon" />
    
    <title>KITAB</title>
  </head>
  <body>
    <!-- ===== NAVBAR ===== -->
    <nav id="mainNav">
      <a href="#" class="logo">KITAB<span class="text_arb">كتاب</span></a>
      <ul class="nav-links">
        <li>
          <a href="marketplace.html" id="nav_marketplace" class="active"
            ><span class="material-icons">local_mall</span> Marketplace</a
          >
        </li>
        <li>
          <a href="messages.html" id="nav_messages"
            ><span class="material-icons">chat_bubble</span> Messages</a
          >
        </li>
        <li>
          <a href="codeHTML.html" id="nav_exchanges"
            ><span class="material-icons">swap_horiz</span> Exchanges</a
          >
        </li>
        <li>
          <a href="fav.html" id="nav_favorites"
            ><span class="material-icons">favorite</span> Favorites</a
          >
        </li>
        <li>
          <a href="reading-rooms.html" id="nav_reading_rooms"
            ><span class="material-icons">import_contacts</span> Reading Rooms</a
          >
        </li>
      </ul>

      <div class="nav-right">
        <a href="profile.html" id="nav_profile"
          ><span class="material-icons">account_circle</span> Profile</a
        >
        <a href="logout.html" id="nav_logout"
          ><span class="material-icons">logout</span>Log out</a
        >

        <div class="lang-switcher-nav">
          <button class="lang-btn" id="btn-en">EN</button>
          <button class="lang-btn" id="btn-fr">FR</button>
          <button class="lang-btn" id="btn-ar">AR</button>
        </div>
      </div>
    </nav>

    <!--COMME PUB-->
    <div class="page-wrapper">
      <section class="hero-slider" id="heroSlider">
        <!-- SLIDE 1 — MARKETPLACE -->
        <div class="slide s1 active" id="slide-0">
          <div class="slide-bg" style="background-image: url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=1800&q=80');"></div>
          <div class="slide-overlay"></div>
          <div class="slide-content">
            <div class="slide-eyebrow">
              <span class="dot"></span> Nouvelle collection — Printemps 2026
            </div>
            <h1 class="slide-title">Les livres trouvent<br /><em>leur lecteur</em></h1>
            <p class="slide-sub">Des milliers de livres d'occasion, rares et neufs. Achetez, vendez ou échangez avec des passionnés comme vous.</p>
          </div>
        </div>

        <!-- SLIDE 2 — READING ROOM -->
        <div class="slide s2" id="slide-2">
          <div class="slide-bg" style="background-image: url('https://media.istockphoto.com/id/1390798814/photo/reading-together-keeps-their-spirits-high.jpg?s=2048x2048&w=is&k=20&c=K2OmYPjL9FJ7vfLaILbLRmINjizA8hMrB5Sefp3Xl7Y=');"></div>
          <div class="slide-overlay"></div>
          <div class="slide-content">
            <div class="slide-eyebrow">
              <span class="dot"></span> Partagez votre passion !
            </div>
            <h1 class="slide-title">Lire ensemble,<br /><em>rêver plus loin</em></h1>
            <p class="slide-sub">Plongez dans notre espace cosy où chaque livre raconte une histoire et chaque lecteur trouve sa place. Partagez, explorez et laissez-vous inspirer par la magie de la lecture collective.</p>
          </div>
        </div>

        <!-- SLIDE 3 — Échange de livres -->
        <div class="slide s3" id="slide-3">
          <div class="slide-bg" style="background-image: url('https://media.istockphoto.com/id/1307288448/photo/high-school-or-college-student-returing-library.jpg?s=2048x2048&w=is&k=20&c=y2GsziTHL6yGHSjd4xM_hm8NFVw7WHXDlCbBuF8V24E=');"></div>
          <div class="slide-overlay"></div>
          <div class="slide-content">
            <div class="slide-eyebrow">
              <span class="dot"></span> Programme d'échange
            </div>
            <h1 class="slide-title">Donnez une<br /><em>seconde vie</em><br />à vos livres</h1>
            <p class="slide-sub">Votre étagère déborde ? Proposez vos livres à l'échange. Réduisez le coût de lecture tout en partageant la culture.</p>
          </div>
        </div>

        <!-- Controls -->
        <div class="slider-dots">
          <button class="dot-btn active" onclick="goTo(0)"></button>
          <button class="dot-btn" onclick="goTo(1)"></button>
          <button class="dot-btn" onclick="goTo(2)"></button>
        </div>

        <div class="slider-arrows">
          <button class="arrow-btn" onclick="prev()">&#8592;</button>
          <button class="arrow-btn" onclick="next()">&#8594;</button>
        </div>

        <div class="slide-counter" id="slideCounter">01 / 03</div>
      </section>

      <!-- PROMO BAND ANIMÉE -->
      <div class="promo-band">
        <div class="promo-items">
          <div class="promo-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            Livraison partout en Tunisie
          </div>
          <div class="promo-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            + 12 000 livres disponibles
          </div>
          <div class="promo-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            Messagerie instantanée
          </div>
          <div class="promo-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>
            Échanges vérifiés & sécurisés
          </div>
          <div class="promo-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
            Paiement 100% sécurisé
          </div>
          <div class="promo-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10H3M21 6H3M21 14H3M21 18H3"/></svg>
            Retours faciles sous 7 jours
          </div>
          <!-- Duplicate for seamless loop -->
          <div class="promo-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            Livraison partout en Tunisie
          </div>
          <div class="promo-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            + 12 000 livres disponibles
          </div>
          <div class="promo-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            Messagerie instantanée
          </div>
          <div class="promo-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>
            Échanges vérifiés & sécurisés
          </div>
          <div class="promo-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
            Paiement 100% sécurisé
          </div>
          <div class="promo-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10H3M21 6H3M21 14H3M21 18H3"/></svg>
            Retours faciles sous 7 jours
          </div>
        </div>
      </div>

      <div class="content">

        <!-- SEARCH BAR -->
        <div class="bloc1">
          <div class="search-right">
            <input class="nav-search" type="text" placeholder="Rechercher un livre…" />
            <button class="nav-btn">Publier un livre</button>
            <button id="exchangeBtn" class="nav-btn">Exchange</button>
          </div>

          <div class="blocfiltration">
            <span style="margin-left: 10px; font-size: 17px"> Filtrer : </span>
            <select name="" id="priceAZselct" class="selectbar">
              <option value="low to height">≡ price: low to height</option>
              <option value="height to low">≡ price: height to low</option>
              <option value="title : A-Z">≡ title : A-Z</option>
            </select>
            <select name="" id="genreselect" class="selectbar">
              <option value="All Genres" selected>All Genres</option>
              <option value="Fiction">Fiction</option>
              <option value="Fantasy">Fantasy</option>
              <option value="Romance">Romance</option>
              <option value="Mystery">Mystery</option>
              <option value="Thriller">Thriller</option>
              <option value="History">History</option>
              <option value="Biography">Biography</option>
              <option value="Science Fiction">Science Fiction</option>
              <option value="Classic Literature">Classic Literature</option>
            </select>
            <select name="" id="constionselect" class="selectbar">
              <option value="All condition" selected>All condition</option>
              <option value="like new">like new</option>
              <option value="Good">Good</option>
              <option value="Fair">Fair</option>
              <option value="Acceptable">Acceptable</option>
            </select>
          </div>
        </div>

        <br>

        <!-- ===== TOUTES LES CARTES DANS UN SEUL cards-container ===== -->
        <div class="cards-container">

          <!-- CARTE 1 — Pride and Prejudice -->
          <div class="book-card">
            <div class="image-container">
              <img src="https://m.media-amazon.com/images/I/81Scutrtj4L._UF1000,1000_QL80_.jpg" alt="" />
              <div class="conditionbook Acceptable">Acceptable</div>
              <div class="forexchange">for exchange</div>
              <label class="heart">
                <input type="checkbox" />
                <span class="icon"><i class="bi bi-heart-fill"></i></span>
              </label>
            </div>
            <div class="card-body">
              <h4 class="nombook">Pride and Prejudice</h4>
              <p>by Jane Austen</p>
              <h6 class="booktype">Classic Literature</h6>
              <span class="price" style="margin-left: 50px; margin-right: 0; color: green">30dt</span>
              <br />
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIV99IJOGUBMQBy9kccOQsAyq36yzt0BRYUw&s" alt="" class="ownerpic" />
              <span class="person">Sarah Johnson</span><br />
              <a href="details.html" class="details"><i class="bi bi-book"></i> Details</a>
              <a href="" class="chat"><i class="bi bi-chat-left"></i> Chat</a>
            </div>
          </div>

          <!-- CARTE 2 — The Martian -->
          <div class="book-card">
            <div class="image-container">
              <img src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1413706054i/18007564.jpg" alt="" />
              <div class="conditionbook Fair">Fair</div>
              <div class="forexchange">for exchange</div>
              <label class="heart">
                <input type="checkbox" />
                <span class="icon"><i class="bi bi-heart-fill"></i></span>
              </label>
            </div>
            <div class="card-body">
              <h4 class="nombook">The Martian</h4>
              <p>by Andy Weir</p>
              <h6 class="booktype">Science Fiction</h6>
              <span class="price" style="margin-left: 50px; margin-right: 0; color: green">40dt</span>
              <br />
              <img src="https://t3.ftcdn.net/jpg/02/99/04/20/360_F_299042079_vGBD7wIlSeNl7vOevWHiL93G4koMM967.jpg" alt="" class="ownerpic" />
              <span class="person">Mohamed lio</span><br />
              <a href="" class="details"><i class="bi bi-book"></i> Details</a>
              <a href="" class="chat"><i class="bi bi-chat-left"></i> Chat</a>
            </div>
          </div>

          <!-- CARTE 3 — ألف ليلة و ليلة -->
          <div class="book-card">
            <div class="image-container">
              <img src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1311932385i/12194590.jpg" alt="" />
              <div class="conditionbook like-new">Like new</div>
              <div class="forexchange">for exchange</div>
              <label class="heart">
                <input type="checkbox" />
                <span class="icon"><i class="bi bi-heart-fill"></i></span>
              </label>
            </div>
            <div class="card-body">
              <h4 class="nombook">ألف ليلة و ليلة</h4>
              <p><br /></p>
              <h6 class="booktype">Classic Literature</h6>
              <span class="price" style="margin-left: 50px; margin-right: 0; color: green">50dt</span>
              <br />
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQLulSTm2MNWTnME2ZcxlhmOU2DvQZgh8wUQ&s" alt="" class="ownerpic" />
              <span class="person">Layan hamdan</span><br />
              <a href="" class="details"><i class="bi bi-book"></i> Details</a>
              <a href="" class="chat"><i class="bi bi-chat-left"></i> Chat</a>
            </div>
          </div>

          <!-- CARTE 4 — Unfortunately, It Was Paradise -->
          <div class="book-card">
            <div class="image-container">
              <img src="https://wardahbooks.com/cdn/shop/products/DSC_5863_1024x1024.jpg?v=1705553150" alt="" />
              <div class="conditionbook good">Good</div>
              <div class="forexchange">for exchange</div>
              <label class="heart">
                <input type="checkbox" />
                <span class="icon"><i class="bi bi-heart-fill"></i></span>
              </label>
            </div>
            <div class="card-body">
              <h4 class="nombook">Unfortunately, It Was Paradise</h4>
              <p>by Mahmoud Darwish</p>
              <h6 class="booktype">History</h6>
              <span class="price" style="margin-left: 50px; margin-right: 0; color: green">60dt</span>
              <br />
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhA_VuqI8DqCHBMlOg_Y6KMjEuJsX_prJX9g&s" alt="" class="ownerpic" />
              <span class="person">Ahmed salah</span><br />
              <a href="" class="details"><i class="bi bi-book"></i> Details</a>
              <a href="" class="chat"><i class="bi bi-chat-left"></i> Chat</a>
            </div>
          </div>

          <!-- CARTE 5 — The Da Vinci Code -->
          <div class="book-card">
            <div class="image-container">
              <img src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1720134686i/30156386.jpg" alt="" />
              <div class="conditionbook Fair">Fair</div>
              <div class="forexchange"></div>
              <label class="heart">
                <input type="checkbox" />
                <span class="icon"><i class="bi bi-heart-fill"></i></span>
              </label>
            </div>
            <div class="card-body">
              <h4 class="nombook">The Da Vinci Code</h4>
              <p>by Dan Brown</p>
              <h6 class="booktype">Mystery</h6>
              <span class="price" style="margin-left: 50px; margin-right: 0; color: green">75.5dt</span>
              <br />
              <img src="https://t4.ftcdn.net/jpg/03/83/25/83/360_F_383258331_D8imaEMl8Q3lf7EKU2Pi78Cn0R7KkW9o.jpg" alt="" class="ownerpic" />
              <span class="person">Jan Bs</span><br />
              <a href="" class="details"><i class="bi bi-book"></i> Details</a>
              <a href="" class="chat"><i class="bi bi-chat-left"></i> Chat</a>
            </div>
          </div>

          <!-- CARTE 6 — L'Amant -->
          <div class="book-card">
            <div class="image-container">
              <img src="https://images.epagine.fr/080/9782369819080_1_75.jpg" alt="" />
              <div class="conditionbook Acceptable">Acceptable</div>
              <div class="forexchange">for exchange</div>
              <label class="heart">
                <input type="checkbox" />
                <span class="icon"><i class="bi bi-heart-fill"></i></span>
              </label>
            </div>
            <div class="card-body">
              <h4 class="nombook">L'Amant</h4>
              <p>by Marguerite Duras</p>
              <h6 class="booktype">Romance</h6>
              <span class="price" style="margin-left: 50px; margin-right: 0; color: green">40dt</span>
              <br />
              <img src="https://t3.ftcdn.net/jpg/02/43/12/34/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg" alt="" class="ownerpic" />
              <span class="person">Roben J</span><br />
              <a href="" class="details"><i class="bi bi-book"></i> Details</a>
              <a href="" class="chat"><i class="bi bi-chat-left"></i> Chat</a>
            </div>
          </div>

          <!-- CARTE 7 — Harry Potter -->
          <div class="book-card">
            <div class="image-container">
              <img src="https://res.cloudinary.com/bloomsbury-atlas/image/upload/w_360,c_scale,dpr_1.5/jackets/9781408855652.jpg" alt="" />
              <div class="conditionbook Acceptable">Acceptable</div>
              <div class="forexchange">for exchange</div>
              <label class="heart">
                <input type="checkbox" />
                <span class="icon"><i class="bi bi-heart-fill"></i></span>
              </label>
            </div>
            <div class="card-body">
              <h4 class="nombook">Harry Potter</h4>
              <p>by J.K. Rowling</p>
              <h6 class="booktype">Fantasy</h6>
              <span class="price" style="margin-left: 50px; margin-right: 0; color: green">54.8dt</span>
              <br />
              <img src="https://plus.unsplash.com/premium_photo-1690407617542-2f210cf20d7e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cGVyc29ufGVufDB8fDB8fHww" alt="" class="ownerpic" />
              <span class="person">Sofia Rossi</span><br />
              <a href="" class="details"><i class="bi bi-book"></i> Details</a>
              <a href="" class="chat"><i class="bi bi-chat-left"></i> Chat</a>
            </div>
          </div>

          <!-- CARTE 8 — أرض زيكولا -->
          <div class="book-card">
            <div class="image-container">
              <img src="https://i.pinimg.com/1200x/17/ff/b7/17ffb7a481c02832e942e151030d5cb0.jpg" alt="" />
              <div class="conditionbook good">good</div>
              <div class="forexchange">for exchange</div>
              <label class="heart">
                <input type="checkbox" />
                <span class="icon"><i class="bi bi-heart-fill"></i></span>
              </label>
            </div>
            <div class="card-body">
              <h4 class="nombook">أرض زيكولا</h4>
              <p>عمرو عبد الحميد</p>
              <h6 class="booktype">Fantasy</h6>
              <span class="price" style="margin-left: 50px; margin-right: 0; color: green">77.8dt</span>
              <br />
              <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8cGVyc29ufGVufDB8fDB8fHww" alt="" class="ownerpic" />
              <span class="person">Amina Salah</span><br />
              <a href="details.html" class="details"><i class="bi bi-book"></i> Details</a>
              <a href="" class="chat"><i class="bi bi-chat-left"></i> Chat</a>
            </div>
          </div>

          <!-- ===== CARTES DYNAMIQUES PHP — même structure exacte ===== -->
          <?php if (empty($books)): ?>
            <p style="text-align:center; width:100%; grid-column: 1/-1;">Aucun livre dynamique trouvé.</p>
          <?php else: ?>
            <?php foreach ($books as $book): ?>
              <div class="book-card">
                <div class="image-container">
                  <img src="uploads/<?php echo htmlspecialchars($book->image); ?>" alt="Livre" />
                  <div class="conditionbook <?php echo strtolower(htmlspecialchars($book->condition)); ?>">
                    <?php echo htmlspecialchars($book->condition); ?>
                  </div>
                  <?php if ($book->for_exchange): ?>
                    <div class="forexchange">for exchange</div>
                  <?php else: ?>
                    <div class="forexchange"></div>
                  <?php endif; ?>
                  <label class="heart">
                    <input type="checkbox" />
                    <span class="icon"><i class="bi bi-heart-fill"></i></span>
                  </label>
                </div>
                <div class="card-body">
                  <h4 class="nombook"><?php echo htmlspecialchars($book->titre); ?></h4>
                  <p>by <?php echo htmlspecialchars($book->auteur); ?></p>
                  <h6 class="booktype"><?php echo htmlspecialchars($book->genre); ?></h6>
                  <span class="price" style="margin-left: 50px; margin-right: 0; color: green">
                    <?php echo number_format($book->prix, 1); ?>dt
                  </span>
                  <br />
                  <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($book->auteur); ?>&background=random" alt="" class="ownerpic" />
                  <span class="person">Vendeur #<?php echo $book->user_id; ?></span><br />
                  <a href="details.php?id=<?php echo $book->id; ?>" class="details">
                    <i class="bi bi-book"></i> Details
                  </a>
                  <a href="chat.php?with=<?php echo $book->user_id; ?>" class="chat">
                    <i class="bi bi-chat-left"></i> Chat
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>

        </div><!-- fin .cards-container -->

      </div><!-- fin .content -->

      <footer class="footer">
        <div class="descrp">
          <div class="KITABdescrp">
            <div class="logo">KITAB<span class="text_arb">كتاب </span></div>
            <p>La marketplace tunisienne dédiée aux livres d'occasion, à l'échange et à la lecture communautaire.</p>
          </div>
          <div class="footerdet">
            <h5>EXPLORER</h5>
            <a href="#">All books</a>
            <a href="#">Reading Room</a>
            <a href="#">Exchange</a>
            <a href="#">New Arrivals</a>
          </div>
          <div class="contact footerdet">
            <h5>CONTACT</h5>
            <p>Email: <br> support@kitab.com</p>
            <p>Téléphone: <br> +216 XX XXX XXX</p>
          </div>
          <div class="footerdet">
            <h5>SUIVEZ-NOUS</h5>
            <a href="#">Facebook</a>
            <a href="#">Instagram</a>
            <a href="#">Twitter</a>
          </div>
        </div>
        <div class="footer-bottom">
          <hr>
          <span>© 2026 KITAB كتاب — Tous droits réservés</span>
          <span>Fait avec ♥ en Tunisie 🇹🇳</span>
        </div>
      </footer>

    </div><!-- fin .page-wrapper -->

    <script src="marketPlace.js"></script>
  </body>
</html>