<?php
session_start();
require_once __DIR__ . '/../config/models/Book.php';
require_once __DIR__ . '/../config/models/User.php';
require_once __DIR__ . '/../config/models/exchange.php';

require_once __DIR__ . '/../core/bootstap.php';
include_once('../config/autoloader.php');
include_once('../config/models/repositories/RoomRepository.php');
require_once __DIR__ . '/../core/auth_middelware.php';

$user = Session::get('user');

if (!Session::isLoggedIn()) {
    header('Location: ../includes/components/restricted-block.php');
    exit;
}

$repo      = new RoomRepository();
$user = $_SESSION['user']['id'];
$exchange = new exchange();
$book = new Book();
$us = new User();

// Récupération des compteurs via le modèle exchange.php
$total     = $exchange->count_all($user);
$completed = $exchange->count_completed($user);
$active    = $exchange->count_active($user);

$success_rate = ($total > 0) ? round(($completed / $total) * 100, 2) : 0;

// Récupération des listes d'échanges
$completed_exchanges = $exchange->recuperer_completed($user);
$accepts             = $exchange->recuperer_accepted($user);
$pending             = $exchange->recuperer_pending($user);
$refused             = $exchange->recuperer_refused($user);
$progress            = $exchange->recuperer_progress($user);
?>
<!DOCTYPE html>
<html xml:lang="en" lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Exchanges</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/messages.css">
    <link rel="stylesheet" href="../assets/css/codeHTML.css">
    <link rel="stylesheet" href="../assets/css/marketPlace.css">
    <link rel="icon" href="../favicon (1).ico" type="image/x-icon">
    <script src="../assets/js/codeHTML.js" defer></script>
    
</head>
<body>
<div class="container-fluid p-0">

    <?php include '../includes/components/bar.php'; ?>

    <section class="container min-vh-100 p-4 exchanges">
        
        <div class="mb-4 mt-2">
            <h1 class="muted fw-bold mb-1 fs-3">BOOK EXCHANGES</h1>
            <p class="text-muted small">Manage your book exchange requests</p>
        </div>

        <!-- Cartes de statistiques -->
        <article class="d-flex justify-content-center mb-4 p-4 rounded-4 custom-dark-bg shadow-lg">
            <div class="row g-3 justify-content-center w-100">
                <?php
                $stats = [
                    ['label' => 'Total Exchanges', 'value' => $total, 'id' => 'total-exchanges'],
                    ['label' => 'Active', 'value' => $active, 'id' => 'active'],
                    ['label' => 'Completed', 'value' => $completed, 'id' => 'completed'],
                    ['label' => 'Success Rate', 'value' => $success_rate . '%', 'id' => 'success-rate'],
                ];
                foreach ($stats as $s): ?>
                <div class="col-md-3 col-sm-6 mb-4 d-flex justify-content-center" style="min-width:150px;">
                    <div class="success-rate border border-1 rounded p-3 w-100 bg-amber-mid">
                        <div class="stat-label text-white"><?= htmlspecialchars($s['label']) ?></div>
                        <div class="stat-number text-white fw-bold fs-3" id="<?= $s['id'] ?>"><?= htmlspecialchars($s['value']) ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </article>

        <!-- Barre de recherche -->
        <article id="search-tool" class="d-flex justify-content-center mb-4 p-3 rounded-4 bg-muted">
            <div class="search-filter-container d-flex align-items-center bg-white border rounded-4 p-3 shadow-sm w-100" style="max-width:800px;">
                <div class="input-group search-input-group rounded-3 flex-grow-1 me-3">
                    <span class="input-group-text bg-transparent border-0 pe-1">
                        <i class="bi bi-search text-muted fs-6"></i>
                    </span>
                    <input type="text" id="searchInput" class="form-control bg-teal border-0 ps-2 fs-6" placeholder="Search by book title or partner name…">
                </div>
                <button class="btn btn-outline-secondary btn-filter d-flex align-items-center rounded-3 px-3 py-2" type="button" id="filterBtn">
                    <i class="bi bi-filter me-2 fs-6"></i>
                    <span class="fs-6 fw-normal text-dark">Filters</span>
                </button>
            </div>
        </article>

        <!-- Filtres radio -->
        <article class="d-flex justify-content-center empl mb-4 p-3 rounded-bottom-4 rounded-top-4 bg-muted" style="display: inline-block; width: auto;">
            <input type="radio" id="activeBtn" name="exchangeFilter" class="exchange-filter" checked style="display: none;">
            <label for="activeBtn" class="filter-label">Active Exchanges</label>
            <input type="radio" id="completedBtn" name="exchangeFilter" class="exchange-filter" style="display: none;">
            <label for="completedBtn" class="filter-label">Completed</label>
            <input type="radio" id="allBtn" name="exchangeFilter" class="exchange-filter" style="display: none;">
            <label for="allBtn" class="filter-label">All Exchanges</label>
        </article>

        <!-- SECTION ACCEPTED (Active) -->
        <section class="mt-4 border border-1 bg-teal-light p-3 exchange-section" id="exchange-Accepted">
            <div class="d-flex justify-content-between align-items-center mb-3 w-100">
                <h2 class="d-flex align-items-center mb-0 muted fw-bold fs-6">
                    <i class="bi bi-check-circle-fill text-success me-2 fs-5"></i>
                    Exchange Accepted
                </h2>
            </div>
            <div class="devider"></div>
            <?php if (empty($accepts)): ?>
                <div class="text-center w-100 p-4 text-white-50">
                    <i class="bi bi-emoji-smile fs-1"></i>
                    <p>No accepted exchanges yet. Keep browsing!</p>
                </div>
            <?php else: foreach ($accepts as $accept): ?>
                <?php 
                    $current_item = $accept;
                    include_once 'includes/controllers/functions/whoUser.php'; 
                ?>
                <div class="position-relative empl mb-4 p-4 rounded-4 w-100 bg-muted d-flex flex-column gap-4">
                    <div class="offering-date text-amber-light border-bottom border-white border-opacity-10 pb-2">
                        Date: <span><?= htmlspecialchars($accept->created_at) ?></span>
                    </div>
                    <div class="book-exchange d-flex align-items-center justify-content-center flex-wrap">
                        <div class="offered-book me-5 text-center">
                            <h3 class="fs-6 mb-2">Your Book</h3>
                            <img src="../photo/<?= htmlspecialchars($book->getBookCover($myBookId)) ?>" alt="Book Cover" width="100" height="150" style="object-fit: cover; border-radius: 8px;">
                            <article class="book-details mt-2">
                                <div class="title fw-bold small"><?= htmlspecialchars($book->getbooktitle($myBookId)) ?></div>
                                <div class="author small"><?= htmlspecialchars($book->getBookAuthor($myBookId)) ?></div>
                                <div class="condition small">Condition: <?= htmlspecialchars($book->getBookCondition($myBookId)) ?></div>
                            </article>
                        </div>
                        <svg class="me-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m16 3 4 4-4 4"/><path d="M20 7H4"/><path d="m8 21-4-4 4-4"/><path d="M4 17h16"/>
                        </svg>
                        <div class="received-book text-center">
                            <h3 class="fs-6 mb-2">Received Book</h3>
                            <img src="../photo/<?= htmlspecialchars($book->getBookCover($partnerBookId)) ?>" alt="Book Cover" width="100" height="150" style="object-fit: cover; border-radius: 8px;">
                            <article class="book-details1 mt-2">
                                <div class="title1 fw-bold small"><?= htmlspecialchars($book->getbooktitle($partnerBookId)) ?></div>
                                <div class="author1 small"><?= htmlspecialchars($book->getBookAuthor($partnerBookId)) ?></div>
                                <div class="condition1 small">Condition: <?= htmlspecialchars($book->getBookCondition($partnerBookId)) ?></div>
                            </article>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-outline-teal btn-sm chat-btn" data-partner-id="<?= $partnerId ?? '' ?>">
                            <i class="bi bi-chat-left-fill me-1"></i> Chat with partner
                        </button>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </section>

        <!-- SECTION PENDING -->
        <section class="pendingResponse mt-4 border border-1 bg-teal-light rounded p-3 exchange-section" id="pending-Exchanges">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="d-flex align-items-center mb-0 muted fw-bold fs-6">
                    <i class="bi bi-hourglass-split text-warning me-2 fs-5"></i>
                    Pending Response
                </h2>
            </div>
            <div class="devider1"></div>
            <?php if (empty($pending)): ?>
                <div class="text-center w-100 p-4 text-white-50">
                    <i class="bi bi-hourglass-top fs-1"></i>
                    <p>No pending requests. You're all caught up!</p>
                </div>
            <?php else: foreach ($pending as $pend): ?>
                <div class="pending-card position-relative empl mb-4 p-4 rounded-4 w-100 bg-muted d-flex flex-column gap-4" data-exchange-id="<?= (int)$pend->id ?>">
                    <div class="offering-date text-amber-light border-bottom border-white border-opacity-10 pb-2">
                        You requested: <span><?= htmlspecialchars($pend->created_at) ?></span>
                    </div>
                    <div class="book-exchange d-flex align-items-center justify-content-center flex-wrap">
                        <div class="your-book me-5 text-center">
                            <h3 class="fs-6 mb-2">Your Book (Offered)</h3>
                            <img src="../photo/<?= htmlspecialchars($book->getBookCover($pend->offer_book_id)) ?>" alt="Book Cover" width="100" height="150" style="object-fit: cover; border-radius: 8px;">
                            <div class="title fw-bold small mt-2"><?= htmlspecialchars($book->getbooktitle($pend->offer_book_id)) ?></div>
                            <div class="author small"><?= htmlspecialchars($book->getBookAuthor($pend->offer_book_id)) ?></div>
                            <div class="condition small">Condition: <?= htmlspecialchars($book->getBookCondition($pend->offer_book_id)) ?></div>
                        </div>
                        <svg class="me-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m16 3 4 4-4 4"/><path d="M20 7H4"/><path d="m8 21-4-4 4-4"/><path d="M4 17h16"/>
                        </svg>
                        <div class="their-book text-center">
                            <h3 class="fs-6 mb-2">Requested Book</h3>
                            <img src="../photo/<?= htmlspecialchars($book->getBookCover($pend->request_book_id)) ?>" alt="Book Cover" width="100" height="150" style="object-fit: cover; border-radius: 8px;">
                            <div class="title fw-bold small mt-2"><?= htmlspecialchars($book->getbooktitle($pend->request_book_id)) ?></div>
                            <div class="author small"><?= htmlspecialchars($book->getBookAuthor($pend->request_book_id)) ?></div>
                            <div class="condition small">Condition: <?= htmlspecialchars($book->getBookCondition($pend->request_book_id)) ?></div>
                        </div>
                    </div>
                    
                    <div class="requesting-person d-flex align-items-center gap-3 mt-2">
                        <?php $imgsrc = $us->getUserAvatar($pend->user_requesting_id); ?>
                        <img src="../photo/<?= htmlspecialchars($imgsrc) ?>" alt="User" width="50" height="50" class="rounded-circle object-fit-cover">
                        <div class="userDescription">
                            <div class="username fw-bold"><?= htmlspecialchars($us->getUserName($pend->user_requesting_id)) ?></div>
                            <div class="rate-stars">
                                <?php
                                $partner_id = $pend->user_requesting_id;
                                $note = $us->getUserRate($partner_id);
                                for ($i = 1; $i <= 5; $i++) {
                                    echo '<i class="bi ' . ($i <= $note ? 'bi-star-fill' : 'bi-star') . ' text-warning me-1"></i>';
                                }
                                ?>
                                <span class="text-white-50 small">(<?= $note ?>/5)</span>
                            </div>
                        </div>
                    </div>

                    <div class="response-buttons d-flex justify-content-center gap-4">
                        <a href="../includes/controllers/functions/traitement_exchange.php?action=accept&id=<?= $pend->id; ?>" class="btn accept-btn btn-teal mt-4">Accept</a>
                        <a href="../includes/controllers/functions/traitement_exchange.php?action=decline&id=<?= $pend->id; ?>" class="btn decline-btn btn-outline-secondary mt-4">Decline</a>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </section>

        <!-- SECTION COMPLETED -->
        <section class="mt-4 border border-1 bg-teal-light p-3 exchange-section" id="completed-Exchanges" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-3 w-100">
                <h2 class="d-flex align-items-center mb-0 muted fw-bold fs-6">
                    <i class="bi bi-check2-circle text-success me-2 fs-5"></i>
                    Completed Exchanges
                </h2>
            </div>
            <div class="devider"></div>
            <?php if (empty($completed_exchanges)): ?>
                <div class="text-center w-100 p-4 text-white-50">
                    <i class="bi bi-emoji-smile fs-1"></i>
                    <p>No completed exchanges yet.</p>
                </div>
            <?php else: foreach ($completed_exchanges as $monexchange): ?>
                <?php 
                    $current_item = $monexchange;
                    include_once 'includes/controllers/functions/whoUser.php';
                ?>
                <div class="position-relative empl mb-4 p-4 rounded-4 w-100 bg-muted d-flex flex-column gap-4">
                    <div class="offering-date text-amber-light border-bottom border-white border-opacity-10 pb-2">
                        Completed Date: <span><?= htmlspecialchars($monexchange->created_at) ?></span>
                    </div>
                    <div class="book-exchange d-flex align-items-center justify-content-center flex-wrap">
                        <div class="offered-book me-5 text-center">
                            <h3 class="fs-6 mb-2">Your Book</h3>
                            <img src="../photo/<?= htmlspecialchars($book->getBookCover($myBookId)) ?>" alt="Book Cover" width="100" height="150" style="object-fit: cover; border-radius: 8px;">
                            <article class="book-details mt-2">
                                <div class="title fw-bold small"><?= htmlspecialchars($book->getbooktitle($myBookId)) ?></div>
                                <div class="author small"><?= htmlspecialchars($book->getBookAuthor($myBookId)) ?></div>
                                <div class="condition small">Condition: <?= htmlspecialchars($book->getBookCondition($myBookId)) ?></div>
                            </article>
                        </div>
                        <svg class="me-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m16 3 4 4-4 4"/><path d="M20 7H4"/><path d="m8 21-4-4 4-4"/><path d="M4 17h16"/>
                        </svg>
                        <div class="received-book text-center">
                            <h3 class="fs-6 mb-2">Received Book</h3>
                            <img src="../photo/<?= htmlspecialchars($book->getBookCover($partnerBookId)) ?>" alt="Book Cover" width="100" height="150" style="object-fit: cover; border-radius: 8px;">
                            <article class="book-details1 mt-2">
                                <div class="title1 fw-bold small"><?= htmlspecialchars($book->getbooktitle($partnerBookId)) ?></div>
                                <div class="author1 small"><?= htmlspecialchars($book->getBookAuthor($partnerBookId)) ?></div>
                                <div class="condition1 small">Condition: <?= htmlspecialchars($book->getBookCondition($partnerBookId)) ?></div>
                            </article>
                        </div>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </section>

        <!-- SECTION REFUSED (cachée par défaut) -->
        <section class="mt-4 border border-1 bg-teal-light p-3 exchange-section" id="refused-Exchanges" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-3 w-100">
                <h2 class="d-flex align-items-center mb-0 muted fw-bold fs-6">
                    <i class="bi bi-x-circle-fill text-danger me-2 fs-5"></i>
                    Refused Exchanges
                </h2>
            </div>
            <div class="devider"></div>
            <?php if (empty($refused)): ?>
                <div class="text-center w-100 p-4 text-white-50">
                    <i class="bi bi-emoji-smile fs-1"></i>
                    <p>No refused exchanges.</p>
                </div>
            <?php else: foreach ($refused as $refuse): ?>
                <?php 
                    $current_item = $refuse;
                    include_once 'includes/controllers/functions/whoUser.php';
                ?>
                <div class="position-relative empl mb-4 p-4 rounded-4 w-100 bg-muted d-flex flex-column gap-4">
                    <div class="offering-date text-amber-light border-bottom border-white border-opacity-10 pb-2">
                        Date: <span><?= htmlspecialchars($refuse->created_at) ?></span>
                    </div>
                    <div class="book-exchange d-flex align-items-center justify-content-center flex-wrap">
                        <div class="offered-book me-5 text-center">
                            <h3 class="fs-6 mb-2">Your Book</h3>
                            <img src="../photo/<?= htmlspecialchars($book->getBookCover($myBookId)) ?>" alt="Book Cover" width="100" height="150" style="object-fit: cover; border-radius: 8px;">
                            <div class="title fw-bold small mt-2"><?= htmlspecialchars($book->getbooktitle($myBookId)) ?></div>
                        </div>
                        <svg class="me-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m16 3 4 4-4 4"/><path d="M20 7H4"/><path d="m8 21-4-4 4-4"/><path d="M4 17h16"/></svg>
                        <div class="received-book text-center">
                            <h3 class="fs-6 mb-2">Asked Book</h3>
                            <img src="../photo/<?= htmlspecialchars($book->getBookCover($partnerBookId)) ?>" alt="Book Cover" width="100" height="150" style="object-fit: cover; border-radius: 8px;">
                            <div class="title1 fw-bold small mt-2"><?= htmlspecialchars($book->getbooktitle($partnerBookId)) ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </section>

        <!-- SECTION IN PROGRESS -->
        <section class="mt-4 border border-1 bg-teal-light p-3 exchange-section" id="in-progress-Exchanges" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-3 w-100">
                <h2 class="d-flex align-items-center mb-0 muted fw-bold fs-6">
                    <i class="bi bi-arrow-repeat text-info me-2 fs-5"></i>
                    In Progress Exchanges
                </h2>
            </div>
            <div class="devider"></div>
            <?php if (empty($progress)): ?>
                <div class="text-center w-100 p-4 text-white-50">
                    <i class="bi bi-emoji-smile fs-1"></i>
                    <p>No in-progress exchanges yet.</p>
                </div>
            <?php else: foreach ($progress as $prog): ?>
                <?php 
                    $current_item = $prog;
                    include_once 'includes/controllers/functions/whoUser.php';
                ?>
                <div class="position-relative empl mb-4 p-4 rounded-4 w-100 bg-muted d-flex flex-column gap-4">
                    <div class="offering-date text-amber-light border-bottom border-white border-opacity-10 pb-2">
                        In Progress Since: <span><?= htmlspecialchars($prog->created_at) ?></span>
                    </div>
                    <div class="book-exchange d-flex align-items-center justify-content-center flex-wrap">
                        <div class="offered-book me-5 text-center">
                            <h3 class="fs-6 mb-2">Your Book</h3>
                            <img src="../photo/<?= htmlspecialchars($book->getBookCover($myBookId)) ?>" alt="Book Cover" width="100" height="150" style="object-fit: cover; border-radius: 8px;">
                            <div class="title fw-bold small mt-2"><?= htmlspecialchars($book->getbooktitle($myBookId)) ?></div>
                        </div>
                        <svg class="me-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m16 3 4 4-4 4"/><path d="M20 7H4"/><path d="m8 21-4-4 4-4"/><path d="M4 17h16"/></svg>
                        <div class="received-book text-center">
                            <h3 class="fs-6 mb-2">Received Book</h3>
                            <img src="../photo/<?= htmlspecialchars($book->getBookCover($partnerBookId)) ?>" alt="Book Cover" width="100" height="150" style="object-fit: cover; border-radius: 8px;">
                            <div class="title1 fw-bold small mt-2"><?= htmlspecialchars($book->getbooktitle($partnerBookId)) ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </section>

    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Filtrage des sections par onglets
    const activeBtn = document.getElementById('activeBtn');
    const completedBtn = document.getElementById('completedBtn');
    const allBtn = document.getElementById('allBtn');
    
    const acceptedSection = document.getElementById('exchange-Accepted');
    const pendingSection = document.getElementById('pending-Exchanges');
    const completedSection = document.getElementById('completed-Exchanges');
    const refusedSection = document.getElementById('refused-Exchanges');
    const progressSection = document.getElementById('in-progress-Exchanges');
    
    function showActiveExchanges() {
        if (acceptedSection) acceptedSection.style.display = 'block';
        if (pendingSection) pendingSection.style.display = 'block';
        if (completedSection) completedSection.style.display = 'none';
        if (refusedSection) refusedSection.style.display = 'none';
        if (progressSection) progressSection.style.display = 'none';
    }
    
    function showCompletedExchanges() {
        if (acceptedSection) acceptedSection.style.display = 'none';
        if (pendingSection) pendingSection.style.display = 'none';
        if (completedSection) completedSection.style.display = 'block';
        if (refusedSection) refusedSection.style.display = 'none';
        if (progressSection) progressSection.style.display = 'none';
    }
    
    function showAllExchanges() {
        if (acceptedSection) acceptedSection.style.display = 'block';
        if (pendingSection) pendingSection.style.display = 'block';
        if (completedSection) completedSection.style.display = 'block';
        if (refusedSection) refusedSection.style.display = 'block';
        if (progressSection) progressSection.style.display = 'block';
    }
    
    if (activeBtn) activeBtn.addEventListener('change', function() {
        if (this.checked) showActiveExchanges();
    });
    
    if (completedBtn) completedBtn.addEventListener('change', function() {
        if (this.checked) showCompletedExchanges();
    });
    
    if (allBtn) allBtn.addEventListener('change', function() {
        if (this.checked) showAllExchanges();
    });
    
    // Recherche
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.pending-card, .position-relative.empl');
            
            cards.forEach(card => {
                const text = card.innerText.toLowerCase();
                if (text.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
    
    // Boutons chat
    document.querySelectorAll('.chat-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const partnerId = this.getAttribute('data-partner-id');
            if (partnerId) {
                window.location.href = '../messages.php?user=' + partnerId;
            } else {
                alert('Chat feature coming soon!');
            }
        });
    });
</script>
</body>
</html>