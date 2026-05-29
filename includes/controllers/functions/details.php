<?php
require_once(__DIR__ . '/../../includes/controllers/book-details-controller.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details - <?php echo htmlspecialchars($book->titre); ?></title>
    <link rel="icon" href="favicon (1).ico" type="image/x-icon" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/details.css" />
</head>
<body>

    <nav id="mainNav">
      <div class="logo">KITAB<span class="text_arb">كتاب </span></div>
      <ul class="nav-links">
        <li><a href="marketplace.php"><i class="bi bi-shop fs-6"></i>Marketplace</a></li>
        <li><a href="messages.php"><i class="bi bi-chat-left-text"></i>Messages</a></li>
        <li><a href="exchange.php"><i class="bi bi-repeat"></i>Exchange</a></li>
        <li><a href="favorites.php"><i class="bi bi-heart"></i>Favoris</a></li>
        <li><a href="reading-rooms.php"><i class="bi bi-book"></i>Reading Room</a></li>
        <hr />
        <li><a href="profile.php"><i class="bi bi-person-circle"></i>Profile</a></li>
        <li><a href="settings.php"><i class="bi bi-gear"></i>Settings</a></li>
        <hr />
      </ul>
    </nav>
    <br />

    <div class="content">
        <div class="w-100">
            
            <a href="../../pages/marketplace.php" class="back" style="text-decoration: none; display: flex; align-items: center; justify-content: flex-start; gap: 8px;">
                &larr; Back to Marketplace
            </a>

            <div class="d-flex gap-4 layout-container">
                
                <div class="detailsside">
                    <div class="imgdetails">
                       <?php 
              
                    if (strpos($book->image, 'http') === 0) {
                         $src_final = htmlspecialchars($book->image);
                    } else {
                   
                     $src_final = "../../uploads/" . htmlspecialchars($book->image);
                            }
?>
<img src="<?php echo $src_final; ?>" alt="Livre cover" />
                    </div>
                    
                    <div style="padding: 20px;">
                        <span style="font-size: 24px; color: #1a1208; font-weight: bold;">
                            <?php echo number_format($book->prix, 1); ?>dt
                        </span>
                        <h6 class="availability">Available</h6>
                        <hr style="color: #ccc;" />
                        
                        <a href="chat.php?with=<?php echo $book->user_id; ?>" class="sugg">
                            <i class="bi bi-chat-left-text"></i> Chat with owner
                        </a>
                        <a href="#" class="sugg"><i class="bi bi-repeat"></i> Request exchange</a>
                        <a href="#" class="sugg"><i class="bi bi-book"></i> Read together</a>
                    </div>
                </div>

                <div class="detailscontent">
                    
                    <div class="bloc">
                        <div class="initial">
                            <h1 style="display: inline-block; margin-top: 10px;">
                                <?php echo htmlspecialchars($book->titre); ?>
                            </h1>
                            <span style="background-color: #f3f393; padding: 5px 12px; border-radius: 10px; margin-left: 15px; font-weight: bold; color: #1a1208;">
                                ⭐ 4.8
                            </span>
                            <p style="color: var(--muted); font-size: 1.1rem; margin-top: 5px;">
                                by <strong><?php echo htmlspecialchars($book->auteur); ?></strong>
                            </p>
                            
                            <h6 class="booktype"><?php echo htmlspecialchars($book->genre); ?></h6>
                            
                            <div class="conditionbook <?php echo $classe_css; ?>">
                                <?php echo $texte_en; ?>
                            </div>

                            <?php if ($book->for_exchange): ?>
                                <div class="forexchange">for exchange</div>
                            <?php endif; ?>
                        </div>
                        
                        <hr />
                        
                        <div class="description">
                            <h1>Description</h1>
                            <p style="line-height: 1.6; color: #333; margin-top: 10px;">
                                <?php echo nl2br(htmlspecialchars($book->description ?? "No description available for this book.")); ?>
                            </p>
                        </div>
                    </div>

                    <div class="bloc">
                        <h1>Book Owner</h1>
                        <br />
                        <div style="display: flex; align-items: center; gap: 20px;">
                            <img src="https://ui-avatars.com/api/?name=User+<?php echo $book->user_id; ?>&background=random" alt="Owner" class="ownerpic" />

                            <div>
                                <span class="person" style="font-weight: bold; font-size: 1.2rem;">Vendeur #<?php echo $book->user_id; ?></span>
                                <p style="margin: 0;">📍 Tunisia, Ariana</p>
                                <p style="font-size: 0.9rem; color: var(--muted); margin: 0;">⭐ 4.9 (127 reviews) • 52 books listed</p>
                            </div>

                            <a href="chat.php?with=<?php echo $book->user_id; ?>" style="margin-left: auto; color: #8b3a1a; font-weight: bold; text-transform: uppercase; border: 1px solid #8b3a1a; padding: 5px 15px; border-radius: 20px; text-decoration: none;">
                                Contact
                            </a>
                        </div>
                    </div>

                    <div class="bloc">
                        <h1>Book Details</h1>
                        <br />
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="width: 50%; vertical-align: top;">
                                    <h3 style="font-size: 1.1rem; color: var(--muted); margin-bottom: 5px;">Condition</h3>
                                    <p style="font-size: 1.2rem; font-weight: 500; margin: 0;"><?php echo $texte_en; ?></p>
                                </td>
                                <td style="width: 50%; vertical-align: top;">
                                    <h3 style="font-size: 1.1rem; color: var(--muted); margin-bottom: 5px;">Genre</h3>
                                    <p style="font-size: 1.2rem; font-weight: 500; margin: 0;"><?php echo htmlspecialchars($book->genre); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 20px;">
                                    <h3 style="font-size: 1.1rem; color: var(--muted); margin-bottom: 5px;">ISBN</h3>
                                    <p style="font-size: 1.2rem; font-weight: 500; margin: 0;"><?php echo htmlspecialchars($book->isbn ?? 'N/A'); ?></p>
                                </td>
                                <td style="padding-top: 20px;">
                                    <h3 style="font-size: 1.1rem; color: var(--muted); margin-bottom: 5px;">Language</h3>
                                    <p style="font-size: 1.2rem; font-weight: 500; margin: 0;"><?php echo htmlspecialchars($book->langue ?? 'English'); ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>