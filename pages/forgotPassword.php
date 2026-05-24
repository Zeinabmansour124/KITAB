<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Exchanges</title>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/messages.css">
  <link rel="stylesheet" href="../assets/css/marketPlace.css">
  <link rel="stylesheet" href="../assets/css/codeHTML.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
  <script src="../assets/js/forgotPassword.js" defer></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
    }

    .exchanges {
      flex-grow: 1;
      margin-left: 300px;
      background: linear-gradient(135deg, #ecebea, #fffefc);
      width: calc(100% - 300px);
    }

    .vert-profond {
      background-color: #3b5d50;
    }

    .pwd-reset {
      background-color: #e2d9c8;
      width: 90%;
      max-width: 400px;
      height: auto;
      min-height: 300px;
      margin: 0 auto;
      top: 50%;
      left: 50%;
      right: 50%;
      transform: translate(-50%, -50%);
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      position: absolute;
    }

    .btn-teal {
      background-color: #0e6b5e !important;
      color: white !important;
      border-color: #0e6b5e !important;
    }

    .text-teal {
      color: #0e6b5e !important;
    }

    .border-teal {
      border-color: #0e6b5e !important;
    }
  </style>
</head>

<body>
  <div class="container-fluid p-0">
     <nav id="mainNav">
      <a href="#" class="logo">KITAB<span class="text_arb">كتاب</span></a>
      <ul class="nav-links">
        <li>
          <a href="marketplace.php" id="nav_marketplace" class="active"
            ><span class="material-icons">local_mall</span> Marketplace</a
          >
        </li>
        <li>
          <a href="messages.php" id="nav_messages"
            ><span class="material-icons">chat_bubble</span> Messages</a
          >
        </li>
        <li>
          <a href="codeHTML.php" id="nav_exchanges"
            ><span class="material-icons">swap_horiz</span> Exchanges</a
          >
        </li>
        <li>
          <a
            href="favorisContenantLivres.html"
            id="nav_favorites"
            ><span class="material-icons">favorite</span> Favorites</a
          >
        </li>
        <li>
          <a href="reading-rooms.php" id="nav_reading_rooms"
            ><span class="material-icons">import_contacts</span> Reading
            Rooms</a
          >
        </li>
      </ul>

      <div class="nav-right">
        <a href="connect.php" id="nav_profile"
          ><span class="material-icons">account_circle</span> Profile</a
        >
        <a href="logout.php" id="nav_logout"
          ><span class="material-icons">logout</span>Log out</a
        >

        <div class="lang-switcher-nav">
          <button class="lang-btn" id="btn-en">EN</button>
          <button class="lang-btn" id="btn-fr">FR</button>
          <button class="lang-btn" id="btn-ar">AR</button>
        </div>
      </div>
    </nav>
    <section class="d-flex justify-content-center end-0 min-vh-100 p-4 exchanges">
      <div class="pwd-reset">
        <div style="display: flex; align-items: center; gap: 9px; justify-content: center; margin: 11px 0;">
          <svg cwidth="100" height="100" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="50" cy="50" r="40" fill="#3b5d50" stroke="#2a4a3a" stroke-width="2" />
            <path d="M50 30 L50 65 M50 75 L50 80" stroke="white" stroke-width="6" stroke-linecap="round" />
          </svg>
        </div>
        <h2 class="text-center muted fw-bold">forgot password ? </h2>
        <p class="muted ">Enter your Email and we will send you a link to reset your password</p>
        <form class="mb-2" style="align-items: center;">
          <input type="email" id="email" class="form-control justify-content-center border-teal" name="email"
            placeholder="email@example.com" required>
        </form>
        <button class="mb-2 btn btn-teal" type="submit">submit</button>
        <div class="mb-2">
          <a href="connect.php" class="text-decoration-underline text-teal text-wrap">Back to login</a>
        </div>
      </div>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>