<?php
include_once('../config/autoloader.php');
include_once('../config/models/repositories/RoomRepository.php');
include_once('../includes/helpers/validate_room.php');


$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    $imagePath = 'default-book.jpg';
    if (!empty($_FILES['image']['name'])) {
        $ext       = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename  = uniqid('room_') . '.' . $ext;
        $uploadDir = '../uploads/rooms/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename)) {
            $imagePath = $filename;
        }
    }

    $data = [
        'titre'            => trim($_POST['titre']             ?? ''),
        'auteur'           => trim($_POST['auteur']            ?? ''),
        'total_pages'      => (int)($_POST['total_pages']      ?? 0),
        'type'             => $_POST['type']                   ?? 'live',
        'max_participants' => (int)($_POST['max_participants'] ?? 15),
        'genre'            => $_POST['genre']                  ?? '',
        'tags'             => implode(',', $_POST['tags']      ?? []),
        'description'      => trim($_POST['description']       ?? ''),
        'host_id'          => $_SESSION['user_id']             ?? 1,
        'image'            => $imagePath,
    ];

    $errors = validateRoom($data);

    if (empty($errors)) {
        $repo = new RoomRepository();
        $repo->create($data);
        header("Location: reading-rooms.php");
        exit();
    }
}

$pageTitle = "Create a Room - KITABI";
$pageCSS   = "reading-room.css";
?>










<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="../assets/css/create-room.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Reading Room - KITABI</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

  
</head>

<body>

  
  <nav class="sidebar">

    <header>
      <div class="logo-text">
        <h1>KITABI <span style="font-family:'DM Sans';font-size:14px;font-weight:400;color:var(--amber-mid);">كتاب</span></h1>
        <span>Your Reading Community</span>
      </div>
    </header>

    <div class="sidebar-nav">
      <a href="marketplace.html" class="sidebar-link">
        <span class="material-icons">local_mall</span> Marketplace
      </a>
      <a href="messages.html" class="sidebar-link">
        <span class="material-icons">chat_bubble</span> Messages
      </a>
      <a href="codeHTML.html" class="sidebar-link">
        <span class="material-icons">swap_horiz</span> Exchanges
      </a>
      <a href="favorisContenantLivres.html" class="sidebar-link">
        <span class="material-icons">favorite</span> Favorites
      </a>
      <a href="reading-rooms.html" class="sidebar-link active">
        <span class="material-icons">import_contacts</span> Reading Rooms
      </a>
    </div>

    <div class="sidebar-footer">
      <div class="footer-links">
        <a href="connect.html">
          <span class="material-icons">account_circle</span> Profile
        </a>
        <a href="logout.html">
          <span class="material-icons">logout</span> Log out
        </a>
      </div>
    </div>

  </nav>

  <div class="content">
    <div class="page-header">
        <h1>Create a Reading Room</h1>
        <p>Set up a new space to read and discuss with the community</p>
    </div>

    <div class="form-wrapper">
        <div class="card">
            <h2 class="card-title">Room Details</h2>
            <p class="card-subtitle">Fill in the information below to create your reading room.</p>

            <?php if ($errors): ?>
                <div class="alert-errors">
                    <?php foreach ($errors as $e): ?>
                        <p>⚠️ <?= htmlspecialchars($e) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" enctype="multipart/form-data">

               <div class="field">
    <label>Book cover</label>
    <label class="upload-btn" for="imageInput">
        <span class="material-icons" style="font-size:18px">upload_file</span>
        <span id="upload-label">Choose a cover image</span>
    </label>
    <input type="file" name="image" id="imageInput" accept="image/*"
           style="display:none"
           onchange="
               const name = this.files[0]?.name;
               document.getElementById('upload-label').textContent = name || 'Choose a cover image';
           "/>
</div>

                <div class="field">
                    <label>Book title</label>
                    <input type="text" name="titre"
                           placeholder="e.g. The Brothers Karamazov"
                           value="<?= htmlspecialchars($_POST['titre'] ?? '') ?>"/>
                </div>

                <div class="field-row">
                    <div class="field">
                        <label>Author</label>
                        <input type="text" name="auteur"
                               placeholder="e.g. Fyodor Dostoevsky"
                               value="<?= htmlspecialchars($_POST['auteur'] ?? '') ?>"/>
                    </div>
                    <div class="field">
                        <label>Total pages</label>
                        <input type="number" name="total_pages" placeholder="e.g. 520" min="1"
                               value="<?= htmlspecialchars($_POST['total_pages'] ?? '') ?>"/>
                    </div>
                </div>

                <div class="field">
                    <label>Room type</label>
                    <div class="type-toggle">
                        <button class="type-opt <?= ($_POST['type'] ?? 'live') === 'live' ? 'selected' : '' ?>"
                                type="button" onclick="setType('live', this)">Live Session</button>
                        <button class="type-opt <?= ($_POST['type'] ?? '') === 'scheduled' ? 'selected' : '' ?>"
                                type="button" onclick="setType('scheduled', this)">Scheduled</button>
                    </div>
                    <input type="hidden" name="type" id="typeInput"
                           value="<?= htmlspecialchars($_POST['type'] ?? 'live') ?>"/>
                </div>

                <div class="field-row">
                    <div class="field">
                        <label>Max participants</label>
                        <input type="number" name="max_participants"
                               placeholder="e.g. 15" min="2" max="50"
                               value="<?= htmlspecialchars($_POST['max_participants'] ?? '') ?>"/>
                    </div>
                    <div class="field">
                        <label>Genre</label>
                        <select name="genre">
                            <option value="" disabled selected>Select genre</option>
                            <?php foreach (['Classic','Sci-Fi','Fantasy','Dystopian','Romance',
                                            'Philosophy','Drama','Adventure','Fiction','Non-Fiction'] as $g): ?>
                                <option value="<?= $g ?>"
                                    <?= ($_POST['genre'] ?? '') === $g ? 'selected' : '' ?>>
                                    <?= $g ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label>Tags</label>
                    <div class="tags-selector">
                        <?php foreach (['Classic','Sci-Fi','Fantasy','Romance','Dystopian',
                                        'Philosophy','Adventure','Drama','Fiction'] as $tag): ?>
                            <button class="tag-opt <?= in_array($tag, $_POST['tags'] ?? []) ? 'selected' : '' ?>"
                                    type="button"
                                    onclick="toggleTag(this)">
                                <?= $tag ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                    <div id="tagsInputs">
                        <?php foreach ($_POST['tags'] ?? [] as $tag): ?>
                            <input type="hidden" name="tags[]" value="<?= htmlspecialchars($tag) ?>"/>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="field">
                    <label>Description (optional)</label>
                    <textarea name="description"
                              placeholder="What will you discuss in this reading room?"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                </div>

                <div class="card-footer">
                    <a href="reading-rooms.php" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-create">Create Room</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
function setType(val, btn) {
    document.getElementById('typeInput').value = val;
    document.querySelectorAll('.type-opt').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
}

function toggleTag(btn) {
    btn.classList.toggle('selected');
    const container = document.getElementById('tagsInputs');
    container.innerHTML = '';
    document.querySelectorAll('.tag-opt.selected').forEach(b => {
        const input   = document.createElement('input');
        input.type    = 'hidden';
        input.name    = 'tags[]';
        input.value   = b.textContent.trim();
        container.appendChild(input);
    });
}
</script>
</body>
</html>