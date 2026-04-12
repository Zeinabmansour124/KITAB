<?php
session_start();
require_once 'config\exchange.php';
require_once 'config\user.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: connect.html');
    exit();
}
$user = $_SESSION['user_id'];
$exchange = new exchange();
$book = new Book();
$us= new User();
$total = $exchange->count_all($user);
$completed = $exchange->count_completed($user);
$active = $exchange->count_active($user);
if ($total > 0) {
    $success_rate = round(($completed / $total) * 100, 2);
} else {
    $success_rate = 0;
}
$mes_echanges = $exchange->recuperer_donnees($user);
$accepts = $exchange->recuperer_accepted($user);
$pending = $exchange->recuperer_pending($user);
?>
<!DOCTYPE html>
<html xml:lang="en" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Exchanges</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="messages.css">
    <link rel="stylesheet" href="codeHTML.css">
    <link rel="stylesheet" href="marketPlace.css">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
        rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&amp;family=DM+Sans:wght@300;400;500&amp;display=swap"
        rel="stylesheet" />
    <link rel="icon" href="favicon (1).ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="codeHTML.js" defer></script>
</head>

<body>
    <div class="container-fluid p-0">
        <nav id="mainNav">
            <a href="#" class="logo">KITAB<span class="text_arb">كتاب</span></a>
            <ul class="nav-links">
                <li>
                    <a href="marketplace.html" id="nav_marketplace" class="active"><span class="material-icons">local_mall</span> Marketplace</a>
                </li>
                <li>
                    <a href="messages.html" id="nav_messages"><span class="material-icons">chat_bubble</span> Messages</a>
                </li>
                <li>
                    <a href="codeHTML.html" id="nav_exchanges"><span class="material-icons">swap_horiz</span> Exchanges</a>
                </li>
                <li>
                    <a
                        href="fav.html"
                        id="nav_favorites"><span class="material-icons">favorite</span> Favorites</a>
                </li>
                <li>
                    <a href="reading-rooms.html" id="nav_reading_rooms"><span class="material-icons">import_contacts</span> Reading
                        Rooms</a>
                </li>
            </ul>

            <div class="nav-right">
                <a href="connect.html" id="nav_profile"><span class="material-icons">account_circle</span> Profile</a>
                <a href="logout.html" id="nav_logout"><span class="material-icons">logout</span>Log out</a>

                <div class="lang-switcher-nav">
                    <button class="lang-btn" id="btn-en">EN</button>
                    <button class="lang-btn" id="btn-fr">FR</button>
                    <button class="lang-btn" id="btn-ar">AR</button>
                </div>
            </div>
        </nav>

        <section class="justify-content-center end-0 min-vh-100 p-4 exchanges">
            <article class="d-flex align-items-center bg-photo border border-1 rounded p-3 mb-4">
                <div class="w-1₀">
                    <h class="display-4 muted fw-bold mb-0 me-3">
                        BOOKEXCHANGES
                    </h>
                    <p class="fs-5 mb-0 text-light ">
                        Manage your book exchanges requests
                    </p>
                </div>
            </article>
            <span class="mx-2"></span>
            <article class="d-flex justify-content-center mb-4 p-4 rounded-4 custom-dark-bg shadow-lg">
                <div class="row g-3 justify-content-center w-100">

                    <div class="col-md-3 col-sm-6 mb-4 d-flex" style="width:150px; ">
                        <div class="success-rate border border-1 rounded p-3 me-3 bg-amber-mid">
                            <div class="stat-label text-white   ">Total Exchanges</div>
                            <div class="stat-number text-white fw-bold fs-3" id="total-exchanges">
                                <?php echo $total ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-4 d-flex" style="width:150px; ">
                        <div class="success-rate border border-1 rounded p-3 me-3 bg-amber-mid">
                            <div class="stat-label text-white   ">Active </div>
                            <div class="stat-number text-white fw-bold fs-3" id="active">
                                <?php echo $active ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4 d-flex" style="width:150px; ">
                        <div class="completed border border-1 rounded p-3 me-3 bg-amber-mid">
                            <div class="stat-label text-white">Completed </div>
                            <div class="stat-number text-white fw-bold fs-3" id="completed">
                                <?php echo $completed ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4 d-flex" style="width:150px; ">
                        <div class="success-rate border border-1 rounded p-3 me-3 bg-amber-mid">
                            <div class="stat-label text-white   ">Success Rate </div>
                            <div class="stat-number text-white fw-bold fs-3" id="success-rate">
                                <?php echo $success_rate ?>%
                            </div>
                        </div>
                    </div>
                </div>

            </article>
            <article id="search-tool" class="d-flex justify-content-center mb-4 p-3 rounded-4 bg-muted">

                <div class="search-filter-container d-flex align-items-center bg-white border rounded-4 p-3 shadow-sm w-100" style="max-width: 800px;">

                    <div class="input-group search-input-group rounded-3 flex-grow-1 me-3">
                        <span class="input-group-text bg-transparent border-0 pe-1" id="search-icon">
                            <i class="bi bi-search text-muted fs-6"></i>
                        </span>
                        <input type="text" class="form-control bg-teal border-0 ps-2 fs-6" method="post" placeholder="Search by book title or partner name..." aria-label="Search" aria-describedby="search-icon">
                    </div>

                    <button class="btn btn-outline-secondary btn-filter d-flex align-items-center rounded-3 px-3 py-2" type="button">
                        <i class="bi bi-filter me-2 fs-6"></i>
                        <span class="fs-6 fw-normal text-dark">Filters</span>
                    </button>

                </div>
            </article>
            <span class=" mx-2  mb-4"></span>
            <article class="d-flex justify-content-center empl mb-4 p-3 rounded-bottom-4 rounded-top-4 d-inline-block bg-muted">
                <input type="radio" id="activeBtn" name="exchangeFilter" class="exchange-filter" checked>
                <label for="activeBtn" class="filter-label">Active Exchanges</label>
                <input type="radio" id="completedBtn" name="exchangeFilter" class="exchange-filter">
                <label for="completedBtn" class="filter-label">Completed</label>
                <input type="radio" id="allBtn" name="exchangeFilter" class="exchange-filter">
                <label for="allBtn" class="filter-label">All Exchanges</label>
            </article>
            <section class="accepted mt-4 push-content-up d-flex align-items-center border border-1 bg-teal-light p-3" id="exchange-Accepted">
                <?php
                foreach ($accepts as $accept) {
                ?>
                <div class="d-flex justify-content-between align-items-center mb-3 w-100">
                    <h class="d-flex align-items-center mb-0 muted fw-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />
                            <circle cx="12" cy="12" r="4" fill="#28a745" />
                            <path d="M11 12.5l1.5 1.5 3-3" stroke="white" stroke-width="1" fill="none" />
                        </svg>
                        Exchange Accepted
                    </h>
                    <button type="button" id="chat-button-Accepted" class="btn btn-outline-teal btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-fill me-1" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z" />
                        </svg>
                        Chat <span id="message-count3">(0)</span>
                    </button>
                </div>
                <div class="devider"> </div>
                <div id="bookAdd3" class="position-relative empl mb-4 p-4 rounded-4 w-100 bg-muted d-flex flex-column gap-4">
                    <div class="offering-date text-amber-light border-bottom border-white border-opacity-10 pb-2">
                        you offered : <span id="offered-date3">
                            <?php
                            echo $accept->created_at;
                            ?>
                        </span>
                    </div>
                    <div class="book-exchange d-flex align-items-center justify-content-center">
                        <div class="offered-book me-5">
                            <h3>Your Book</h3>
                            <img class="cover" data-book-id="" src="" alt="Book Cover" width="100" height="150">
                            <article class="book-details">
                                <th class="title" data-book-id="">
                                    <?php
                                    $booktitle = $book->getbooktitle($accept->your_book_id);
                                    echo $booktitle;
                                    ?>
                                </th>
                                <div class="author" data-book-id="">
                                    <?php
                                    $bookAuthor = $book->getBookAuthor($accept->your_book_id);
                                    echo $bookAuthor;
                                    ?>
                                </div>
                                <div class="condition" data-book-id=""> Condition:
                                    <?php
                                    $bookCondition = $book->getBookCondition($accept->your_book_id);
                                    echo $bookCondition;
                                    ?>
                                </div>
                            </article>
                        </div>
                        <svg class="me-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m16 3 4 4-4 4" />
                            <path d="M20 7H4" />
                            <path d="m8 21-4-4 4-4" />
                            <path d="M4 17h16" />
                        </svg>
                        <div class="received-book ">
                            <h3>Received Book</h3>
                            <img class="cover1" data-book-id="" src="" alt="Book Cover1" width="100" height="150">
                            <article class="book-details1">
                                <th class="title1" data-book-id="">
                                    <?php
                                    $booktitle1 = $book->getbooktitle($accept->partner_book_id);
                                    echo $booktitle1;
                                    ?>
                                </th>
                                <div class="author1" data-book-id="">
                                    <?php
                                    $bookAuthor1 = $book->getBookAuthor($accept->partner_book_id);
                                    echo $bookAuthor1;
                                    ?>
                                </div>
                                <div class="condition1" data-book-id="">
                                    Condition:
                                    <?php
                                    $bookCondition1 = $book->getBookCondition($accept->partner_book_id);
                                    echo $bookCondition1;
                                    ?>
                                </div>
                            </article>
                        </div>
                    </div>

            <?php
                }
            ?>
            </section>
            <section class="pendingResponse position-relative mt-4 border border-1 bg-teal-light rounded p-3 " id="pending-Exchanges">
                <?php
                foreach ($pending as $pend) {
                ?>
                <div class="d-flex justify-content-between align-items-center mb-3 ">
                    <h class="d-flex align-items-center mb-0 muted fw-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" class="me-2">
                            <path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5zm2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702c0 .7-.478 1.235-1.011 1.491A3.5 3.5 0 0 0 4.5 13v1h7v-1a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351v-.702c0-.7.478-1.235 1.011-1.491A3.5 3.5 0 0 0 11.5 3V2h-7z" />
                        </svg>
                        Pending Response
                    </h>
                    <button type="button" id="chat-button1" class="btn btn-outline-teal btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-fill me-1" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z" />
                        </svg>
                        Chat <span id="message-count1">(0)</span>
                    </button>
                </div>

                <div class="devider1"></div>
                <div id="LivresEnAttente"></div>
                <div id="book_requested" class="position-relative empl mb-4 p-4 rounded-4 w-100 bg-muted d-flex flex-column gap-4">
                    <div class="offering-date text-amber-light border-bottom border-white border-opacity-10 pb-2">
                        you requested: <span id="requested-date"> 
                            <?php
                            echo $pend->created_at;
                            ?>
                        </span>
                    </div>
                    <div class="book-exchange d-flex align-items-center justify-content-center">
                        <div class="your-book me-5">
                            <h3>Your Book</h3>
                            <img class="cover2" data-book-id="" src="" alt="Book Cover2" width="100" height="150">
                            <article class="book-details2">
                                <th class="title2" data-book-id=""> 
                                    <?php
                                    $booktitle= $book->getbooktitle($pend->your_book_id);
                                    echo $booktitle2;
                                    ?>
                                </th>
                                <div class="author2" data-book-id="">
                                    <?php
                                    $bookAuthor= $book->getBookAuthor($pend->your_book_id);
                                    echo $bookAuthor2;
                                    ?>
                                </div>
                                <div class="condition2" data-book-id=""> Condition: 
                                    <?php echo $book->getBookCondition($pend->your_book_id); ?>
                                </div>
                            </article>
                        </div>
                        <svg class="me-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m16 3 4 4-4 4" />
                            <path d="M20 7H4" />
                            <path d="m8 21-4-4 4-4" />
                            <path d="M4 17h16" />
                        </svg>
                        <div class="their-book">
                            <h3>Received Book</h3>
                            <img class="cover3" data-book-id="" src="" alt="Book Cover3" width="100" height="150">
                            <article class="book-details3">
                                <th class="title3" data-book-id=""> 
                                    <?php
                                    $booktitle3 = $book->getbooktitle($pend->partner_book_id);
                                    echo $booktitle3;
                                    ?>
                                </th>
                                <div class="author3" data-book-id=""> 
                                    <?php
                                    $bookAuthor3 = $book->getBookAuthor($pend->partner_book_id);
                                    echo $bookAuthor3;
                                    ?>
                                </div>
                                <div class="condition3" data-book-id=""> Condition: 
                                    <?php echo $book->getBookCondition($pend->partner_book_id); ?>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div id="requesting-person ">
                        <?php
                        $imgsrc= $us->getUserImage($pend->user_offering_id);
                        ?>
                        <img id="userImage7" src="<=? $imgsrc; ?>" alt="User" width="50" height="50">
                        <div class="userDescription">
                            <div class="username" id="username">
                                <?php
                                $username = $us->getUserName($pend->user_offering_id);
                                echo $username;
                                ?>
                            </div>
                            <div class="location" id="location"> 
                                <?php
                                $userLocation = $us->getUserLocation($pend->user_offering_id);
                                echo $userLocation;
                                ?>
                            </div>
                            <div class="rate"></div>
                            <div id="etoile-vide"></div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const etoileVide = document.getElementById('etoile-vide');
                                    etoileVide.innerHTML = '';
                                    if (etoileVide) {
                                        for (let i = 0; i < 5; i++) {
                                            let ne = document.createElement('i');
                                            ne.className = 'bi bi-star text-warning me-1';
                                            etoileVide.appendChild(ne);
                                        }
                                    }
                                })
                            </script>
                            <template class="bi bi-star-fill text-warning fs-4"></template>
                            <div class="rating" id="rating"> Loading...</div>
                        </div>
                    </div>
                    <div class="response-buttons d-flex justify-content-center ">
                        <INPUT TYPE="submit" VALUE="Accept" class="Accept btn-teal mt-4 me-5" id="accept-request">
                        <INPUT TYPE="submit" VALUE="Decline" class="refuse btn-outline-secondary mt-4" id="decline-request">
                    </div>

                </div>
            <?php
                }
            ?>

            </section>
            <section class="accepted mt-4 push-content-up d-flex align-items-center border border-1 bg-teal-light p-3" id="completed-Exchanges">
                <?php
                foreach ($mes_echanges as $monexchange) {
                ?>
                    <div id="bookAdd7" class="position-relative empl mb-4 p-4 rounded-4 w-100 bg-muted d-flex flex-column gap-4">
                        <div class="offering-date text-amber-light border-bottom border-white border-opacity-10 pb-2">
                            you offered : <span id="offered-date5">
                                <?php
                                echo $monexchange->offered_date;
                                ?>
                            </span>
                        </div>

                        <div class="book-exchange d-flex align-items-center justify-content-center flex-wrap">

                            <div class="offered-book me-5">
                                <h3>Your Book</h3>
                                <img class="cover" data-book-id="" src="" alt="Book Cover" width="100" height="150">
                                <article class="book-details">
                                    <th class="title" data-book-id="">
                                        <?php
                                        $booktitle = $book->getBooktitle($monexchange->your_book_id);
                                        echo $booktitle;
                                        ?>
                                    </th>
                                    <div class="author" data-book-id="">
                                        <?php
                                        $bookAuthor = $book->getBookAuthor($monexchange->your_book_id);
                                        echo $bookAuthor;
                                        ?>
                                    </div>
                                    <div class="condition" data-book-id=""> Condition:
                                        <?php
                                        $bookCondition = $book->getBookCondition($monexchange->your_book_id);
                                        echo $bookCondition;
                                        ?>
                                    </div>
                                </article>
                            </div>

                            <svg class="me-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m16 3 4 4-4 4" />
                                <path d="M20 7H4" />
                                <path d="m8 21-4-4 4-4" />
                                <path d="M4 17h16" />
                            </svg>

                            <div class="received-book">
                                <h3>Received Book</h3>
                                <img class="cover1" data-book-id="" src="" alt="Book Cover1" width="100" height="150">
                                <article class="book-details1">
                                    <th class="title1" data-book-id="">
                                        <?php
                                        $booktitle1 = $book->getBooktitle($monexchange->partner_book_id);
                                        echo $booktitle1;
                                        ?>
                                    </th>
                                    <div class="author1" data-book-id="">
                                        <?php
                                        $bookAuthor1 = $book->getBookAuthor($monexchange->partner_book_id);
                                        echo $bookAuthor1;
                                        ?>
                                    </div>
                                    <div class="condition1" data-book-id=""> Condition:
                                        <?php
                                        $bookCondition1 = $book->getBookCondition($monexchange->partner_book_id);
                                        echo $bookCondition1;
                                        ?>
                                    </div>
                                </article>
                            </div>

                            <div class="exchange-rate w-100 border-top border-white border-opacity-25 mt-4 pt-3 text-amber-light text-center">
                                Exchange Rate : <span id="rating-star" class="ms-2"></span>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const etoileVide = document.getElementById('rating-star');
                                        if (etoileVide) {
                                            etoileVide.innerHTML = '';
                                            for (let i = 0; i < 5; i++) {
                                                let ne = document.createElement('i');
                                                ne.className = 'bi bi-star text-warning me-1';
                                                etoileVide.appendChild(ne);
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </section>
            <section class="accepted mt-4 push-content-up d-flex align-items-center border border-1 bg-teal-light p-3" id="refused-Exchanges">
                <div class="d-flex justify-content-between align-items-center mb-3 w-100">
                    <h class="d-flex align-items-center mb-0 muted fw-bold">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" y="11" width="14" height="10" rx="2" stroke="#dc3545" stroke-width="2" fill="none" />
                            <path d="M8 11L8 7C8 4.79 9.79 3 12 3C14.21 3 16 4.79 16 7L16 11" stroke="#dc3545" stroke-width="2" />
                            <path d="M12 15L12 18" stroke="#dc3545" stroke-width="2" stroke-linecap="round" />
                            <circle cx="12" cy="15" r="1" fill="#dc3545" />
                        </svg>
                        refused Exchanges
                    </h>
                    <button type="button" id="chat-button-refused" class="btn btn-outline-teal btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-fill me-1" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z" />
                        </svg>
                        Chat <span id="message-count6">(0)</span>
                    </button>
                </div>
                <div class="devider"> </div>
                <div id="livresEchnangesAcceptes6">

                </div>
                <div id="bookAddRefused" class="position-relative empl mb-4 p-4 rounded-4 w-100 bg-muted d-flex flex-column gap-4">
                    <div class="offering-date text-amber-light border-bottom border-white border-opacity-10 pb-2">
                        you offered : <span id="offered-date6"> Loading...</span>
                    </div>
                    <div class="book-exchange d-flex align-items-center justify-content-center">
                        <div class="offered-book me-5">
                            <h3>Your Book</h3>
                            <img class="cover" data-book-id="" src="" alt="Book Cover" width="100" height="150">
                            <article class="book-details">
                                <th class="title" data-book-id=""> Loading...</th>
                                <div class="author" data-book-id=""> Loading...</div>
                                <div class="condition" data-book-id=""> Condition: Loading...</div>
                            </article>
                        </div>
                        <svg class="me-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m16 3 4 4-4 4" />
                            <path d="M20 7H4" />
                            <path d="m8 21-4-4 4-4" />
                            <path d="M4 17h16" />
                        </svg>
                        <div class="received-book">
                            <h3>Asked Book</h3>
                            <img class="cover1" data-book-id="" src="" alt="Book Cover1" width="100" height="150">
                            <article class="book-details1">
                                <th class="title1" data-book-id=""> Loading...</th>
                                <div class="author1" data-book-id=""> Loading...</div>
                                <div class="condition1" data-book-id=""> Condition: Loading...</div>
                            </article>
                        </div>
                    </div>

            </section>
            <section class="accepted mt-4 push-content-up d-flex align-items-center border border-1 bg-teal-light p-3" id="in-progress-Exchanges">
                <div class="d-flex justify-content-between align-items-center mb-3 w-100">
                    <h class="d-flex align-items-center mb-0 muted fw-bold">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10" stroke="#3b5d50" stroke-width="2" fill="none" />
                            <path d="M12 2 L12 6" stroke="#3b5d50" stroke-width="2" stroke-linecap="round" />
                            <circle cx="12" cy="12" r="2" fill="#3b5d50" />
                        </svg>
                        in progress Exchanges
                    </h>
                    <button type="button" id="chat-button-in-progress" class="btn btn-outline-teal btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-fill me-1" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z" />
                        </svg>
                        Chat <span id="message-count7">(0)</span>
                    </button>
                </div>
                <div class="devider"> </div>
                <div id="livresEchnangesAcceptes7">

                </div>
                <div id="bookAdd-progress" class="position-relative empl mb-4 p-4 rounded-4 w-100 bg-muted d-flex flex-column gap-4">
                    <div class="offering-date text-amber-light border-bottom border-white border-opacity-10 pb-2">
                        you offered : <span id="offered-date7"> Loading...</span>
                    </div>
                    <div class="book-exchange d-flex align-items-center justify-content-center flex-wrap">
                        <div class="offered-book me-5">
                            <h3>Your Book</h3>
                            <img class="cover" src="" alt="Book Cover" width="100" height="150">
                            <article class="book-details">
                                <div class="title fw-bold"> Loading...</div>
                                <div class="author"> Loading...</div>
                                <div class="condition"> Condition: Loading...</div>
                            </article>
                        </div>
                        <svg class="me-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m16 3 4 4-4 4" />
                            <path d="M20 7H4" />
                            <path d="m8 21-4-4 4-4" />
                            <path d="M4 17h16" />
                        </svg>
                        <div class="received-book">
                            <h3>Received Book</h3>
                            <img class="cover1" src="" alt="Book Cover1" width="100" height="150">
                            <article class="book-details1">
                                <div class="title1 fw-bold"> Loading...</div>
                                <div class="author1"> Loading...</div>
                                <div class="condition1"> Condition: Loading...</div>
                            </article>
                        </div>
                        <div class="arriving-date w-100 border-top border-white border-opacity-25 mt-4 pt-3  text-amber-light">
                            arrives : <span id="arriving-date" class="fw-bold"> Loading...</span>
                        </div>
                    </div>
                </div>

            </section>

    </div>
    </section>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>