<?php

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
$lives     =  $repo->findByType('live');
$scheduled = $repo->findByType('scheduled');

// Rooms du user connecté
$myRooms = [];
if (isset($_SESSION['user'])) {
    $myRooms = $repo->findByHostId($_SESSION['user']['id']);
}

$pageTitle = "Reading Rooms - KITABI";
$pageCSS   = "reading-room.css";
?>
<!DOCTYPE html>
<html lang="en">
<?php require('../includes/components/head.php'); ?>
<body>
<?php require('../includes/components/bar.php'); ?>

      
<div class="page-wrapper">
    <div class="page-header">
        <div class="page-header-text">
            <h1 id="page_title">Reading Rooms</h1>
            <h4 id="page_subtitle">Read together with the community</h4>
        </div>
        <a href="create_file.php" class="create-room-btn">+ Create Room</a>
    </div>

    <div class="page-body">

        <!-- Stats -->
        <div class="stats-container">
            <div class="stat-card live">
                <div class="stat-info">
                    <div class="stat-title" id="stat_live">Live Now</div>
                    <div class="stat-number"><?= count($lives) ?></div>
                </div>
                <div class="stat-icon">
                    <img src="https://i.pinimg.com/736x/cf/ac/d5/cfacd53f5bc159e0c2c01b69f3de1771.jpg" alt="Live"/>
                </div>
            </div>
            <div class="stat-card scheduled">
                <div class="stat-info">
                    <div class="stat-title" id="stat_scheduled">Scheduled</div>
                    <div class="stat-number"><?= count($scheduled) ?></div>
                </div>
                <div class="stat-icon">
                    <img src="https://i.pinimg.com/1200x/ea/fb/8b/eafb8b1c4c949f9343740e590c5652c8.jpg" alt="Scheduled"/>
                </div>
            </div>
            <div class="stat-card myrooms">
                <div class="stat-info">
                    <div class="stat-title" id="stat_myrooms">My Rooms</div>
                    <div class="stat-number"><?= count($myRooms) ?></div>
                </div>
                <div class="stat-icon">
                    <img src="https://i.pinimg.com/1200x/c3/41/6e/c3416efade9f62b399498e657113ddf7.jpg" alt="My Rooms"/>
                </div>
            </div>
            <div class="stat-card totalreaders">
                <div class="stat-info">
                    <div class="stat-title" id="stat_readers">Total Rooms</div>
                    <div class="stat-number"><?= count($lives) + count($scheduled) ?></div>
                </div>
                <div class="stat-icon">
                    <img src="https://i.pinimg.com/736x/7a/9c/51/7a9c5126a655aa763c4f7e830c03a2f5.jpg" alt="Total"/>
                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="search-area">
            <input type="text" class="search-bar" id="search_bar"
                   placeholder="🔍  Search by book title or author…"/>
        </div>

        <!-- Tabs -->
        <div class="nav-tabs">
            <a href="#" class="nav-tab active" id="tab_discover">Discover</a>
            <a href="#" class="nav-tab"        id="tab_live">Live now</a>
            <a href="#" class="nav-tab"        id="tab_scheduled">Scheduled</a>
            <a href="#" class="nav-tab"        id="tab_myrooms">My rooms</a>
        </div>
        <hr class="separator"/>

        <!-- Live -->
        <div id="live-section">
            <div class="section-label" id="section_live">Live Sessions</div>
            <div class="rooms-container">
                <?php if (empty($lives)): ?>
                    <p style="color:var(--muted)">No live sessions at the moment.</p>
                <?php else: ?>
                    <?php foreach ($lives as $room): ?>
                    <div class="room-card">
                        <div class="room-image">
                            <?php $src = str_starts_with($room->image, 'http') ? $room->image : '../uploads/rooms/' . $room->image; ?>
                            <img src="<?= htmlspecialchars($src) ?>" alt="<?= htmlspecialchars($room->titre) ?>"/>
                            <span class="badge live">LIVE</span>
                            <span class="participants">0/<?= $room->max_participants ?></span>
                        </div>
                        <div class="room-content">
                            <div>
                                <h3><?= htmlspecialchars($room->titre) ?></h3>
                                <p class="room-author"><?= htmlspecialchars($room->auteur) ?></p>
                            </div>
                            <div class="progress-container">
                                <div class="progress-bar-bg">
                                    <div class="progress-bar-fill" style="width:0%"></div>
                                </div>
                                <p class="progress-text">Page 0 of <?= $room->total_pages ?></p>
                            </div>
                            <?php if ($room->tags): ?>
                            <div class="tags">
                                <?php foreach (explode(',', $room->tags) as $tag): ?>
                                    <span class="tag"><?= htmlspecialchars(trim($tag)) ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                            <button class="room-action-btn join-btn btn_join">Join Now</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Scheduled -->
        <div id="scheduled-section">
            <div class="section-label" style="margin-top:36px" id="section_upcoming">Upcoming Sessions</div>
            <div class="rooms-container">
                <?php if (empty($scheduled)): ?>
                    <p style="color:var(--muted)">No upcoming sessions.</p>
                <?php else: ?>
                    <?php foreach ($scheduled as $room): ?>
                    <div class="room-card">
                        <div class="room-image">
                            <?php $src = str_starts_with($room->image, 'http') ? $room->image : '../uploads/rooms/' . $room->image; ?>
                            <img src="<?= htmlspecialchars($src) ?>" alt="<?= htmlspecialchars($room->titre) ?>"/>
                            <span class="badge scheduled">Scheduled</span>
                            <span class="participants">0/<?= $room->max_participants ?></span>
                        </div>
                        <div class="room-content">
                            <div>
                                <h3><?= htmlspecialchars($room->titre) ?></h3>
                                <p class="room-author"><?= htmlspecialchars($room->auteur) ?></p>
                            </div>
                            <div class="progress-container">
                                <div class="progress-bar-bg">
                                    <div class="progress-bar-fill" style="width:0%"></div>
                                </div>
                                <p class="progress-text">Page 0 of <?= $room->total_pages ?></p>
                            </div>
                            <?php if ($room->tags): ?>
                            <div class="tags">
                                <?php foreach (explode(',', $room->tags) as $tag): ?>
                                    <span class="tag"><?= htmlspecialchars(trim($tag)) ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                            <button class="room-action-btn rsvp-btn btn_rsvp">RSVP</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- My Rooms -->
        <div id="myrooms-section" style="display:none">
            <?php if (empty($myRooms)): ?>
                <div class="myrooms-content">
                    <div class="myrooms-text">
                        <h3 id="no_rooms">No rooms yet</h3>
                        <p id="no_rooms_sub">Create your own room or join an existing one.</p>
                        <a href="create_file.php" class="create-room-btn">+ Create Room</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="rooms-container" style="margin-top:16px">
                    <?php foreach ($myRooms as $room): ?>
                    <div class="room-card">
                        <div class="room-image">
                            <?php $src = str_starts_with($room->image, 'http') ? $room->image : '../uploads/rooms/' . $room->image; ?>
                            <img src="<?= htmlspecialchars($src) ?>" alt="<?= htmlspecialchars($room->titre) ?>"/>
                            <span class="badge <?= $room->type ?>">
                                <?= $room->type === 'live' ? 'LIVE' : 'Scheduled' ?>
                            </span>
                            <span class="participants">0/<?= $room->max_participants ?></span>
                        </div>
                        <div class="room-content">
                            <div>
                                <h3><?= htmlspecialchars($room->titre) ?></h3>
                                <p class="room-author"><?= htmlspecialchars($room->auteur) ?></p>
                            </div>
                            <div class="progress-container">
                                <div class="progress-bar-bg">
                                    <div class="progress-bar-fill" style="width:0%"></div>
                                </div>
                                <p class="progress-text">Page 0 of <?= $room->total_pages ?></p>
                            </div>
                            <?php if ($room->tags): ?>
                            <div class="tags">
                                <?php foreach (explode(',', $room->tags) as $tag): ?>
                                    <span class="tag"><?= htmlspecialchars(trim($tag)) ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                            <button class="room-action-btn join-btn">Manage</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- No search result -->
        <div id="no-result" style="display:none">
            <h3 id="no_rooms_search">No rooms found</h3>
            <p><span id="no_rooms_sub_search">No reading room matches</span>
               "<span id="search-query"></span>"</p>
        </div>

    </div>
</div>

<!-- Popup Join -->
<div id="joinPopup">
    <div class="popup-box">
        <div class="popup-header">
            <h3 id="popupTitle">Join Room</h3>
            <button class="popup-close" onclick="closePopup()">✕</button>
        </div>
        <p id="popupBook"></p>
        <div class="input-group">
            <input type="text"  id="popupName"  placeholder="Your name"/>
            <small id="errorName">Please enter your name</small>
        </div>
        <div class="input-group">
            <input type="email" id="popupEmail" placeholder="Your email"/>
            <small id="errorEmail">Please enter a valid email</small>
        </div>
        <div class="popup-actions">
            <button id="confirmJoin" onclick="confirmJoin()">Join</button>
            <button id="cancelJoin"  onclick="closePopup()">Cancel</button>
        </div>
    </div>
</div>

<div id="successMessage"><span id="successText"></span></div>

<script src="../assets/js/notifications.js"></script>
<script src="../assets/js/RSVP.js"></script>
<script src="../assets/js/join.js"></script>
<script src="../assets/js/fontsize.js"></script>
<script src="../assets/js/fullscreen.js"></script>
<script src="../assets/js/ambiance.js"></script>
<script src="../assets/js/mode.js"></script>

<script>
// Search
document.querySelector(".search-bar").addEventListener("input", function () {
    const query = this.value.trim().toLowerCase();
    const cards = document.querySelectorAll(".room-card");
    let found = 0;
    cards.forEach(card => {
        const title  = card.querySelector("h3").textContent.toLowerCase();
        const author = card.querySelector(".room-author").textContent.toLowerCase();
        const show   = query === "" || title.includes(query) || author.includes(query);
        card.style.display = show ? "flex" : "none";
        if (show) found++;
    });
    document.getElementById("no-result").style.display =
        found === 0 && query !== "" ? "flex" : "none";
    document.getElementById("search-query").textContent = query;
});

// Tabs
document.querySelectorAll(".nav-tab").forEach(tab => {
    tab.addEventListener("click", function (e) {
        e.preventDefault();
        document.querySelectorAll(".nav-tab").forEach(t => t.classList.remove("active"));
        this.classList.add("active");
        document.getElementById("live-section").style.display      = "none";
        document.getElementById("scheduled-section").style.display = "none";
        document.getElementById("myrooms-section").style.display   = "none";
        if (this.id === "tab_live")      document.getElementById("live-section").style.display      = "block";
        if (this.id === "tab_scheduled") document.getElementById("scheduled-section").style.display = "block";
        if (this.id === "tab_myrooms")   document.getElementById("myrooms-section").style.display   = "flex";
        if (this.id === "tab_discover") {
            document.getElementById("live-section").style.display      = "block";
            document.getElementById("scheduled-section").style.display = "block";
        }
    });
});
</script>
</body>
</html>