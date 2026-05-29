<?php
require_once('../../../core/bootstap.php');      
require_once('../../../config/autoloader.php');


$currentUser = Session::getUser();
$isLoggedIn  = Session::isLoggedIn();
$error   = null;
$success = null;

if (!$isLoggedIn) {
    header('Location: ../../../includes/components/restricted-block.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $bookRepo = new BookRepository();
        
        $imagePath = 'default_book.png';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $ext      = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $fileName = uniqid('book_') . '.' . $ext;
            $uploadDir = __DIR__ . '/../../uploads/';
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName);
            $imagePath = $fileName;
        }

        $bookRepo->create([
            'user_id'      => $currentUser['id'],  
            'titre'        => $_POST['titre'],
            'auteur'       => $_POST['auteur'],
            'prix'         => $_POST['prix'],
            'genre'        => $_POST['genre'],
            'condition'    => $_POST['condition'],
            'description'  => $_POST['description'],
            'image'        => $imagePath,
            'for_exchange' => isset($_POST['exchange']) ? 1 : 0
        ]);

        $success = "Votre livre a été publié avec succès !";
    } catch (Exception $e) {
        
        $error = "Erreur lors de la publication : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Publier un livre - KITAB</title>
    <link rel="stylesheet" href="../../../assets/css/main.css">
    <link rel="stylesheet" href="../../../assets/css/publish.css">
    <link rel="stylesheet" href="../../../assets/css/bar.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
</head>
<body>

<?php include('../../../includes/components/bar.php'); ?> 


<main class="page-body">

    <div class="form-card">
        <div class="form-card-header">
            <span class="material-icons">auto_stories</span>
            <div>
                <h2>Publier un nouveau livre</h2>
                <p>Remplissez les informations pour partager votre ouvrage.</p>
            </div>
        </div>

        <?php if ($success): ?>
        <div id="successOverlay" style="position:fixed;inset:0;background:rgba(0,0,0,0.55);z-index:9999;display:flex;align-items:center;justify-content:center;">
          <div id="successBox" style="background:#fff;border-radius:16px;padding:2.5rem 2rem;text-align:center;max-width:380px;width:90%;transform:scale(0.7);opacity:0;transition:transform 0.4s cubic-bezier(.34,1.56,.64,1),opacity 0.3s ease;">
            <div style="width:72px;height:72px;border-radius:50%;background:#e8f5e9;margin:0 auto 1.2rem;display:flex;align-items:center;justify-content:center;">
              <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2e7d32" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
            </div>
            <h3 style="margin:0 0 0.5rem;font-size:1.3rem;color:#1b5e20;">Livre publié avec succès !</h3>
            <p style="color:#555;font-size:0.95rem;margin:0 0 1.5rem;">Votre livre est maintenant visible sur la marketplace.</p>
            <a href="../../../pages/marketplace.php"
               style="display:inline-block;background:#2e7d32;color:#fff;padding:0.65rem 1.8rem;border-radius:8px;text-decoration:none;font-size:0.95rem;">
               ← Retour à la Marketplace
            </a>
          </div>
        </div>
        <script>
          window.addEventListener('load', function() {
            const box = document.getElementById('successBox');
            setTimeout(function() {
              box.style.transform = 'scale(1)';
              box.style.opacity = '1';
            }, 50);
          });
        </script>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data" class="form-body">

            <div class="form-grid">
                <div class="field full">
                    <label><span class="material-icons">title</span> Titre du livre <span class="req">*</span></label>
                    <input type="text" name="titre" required placeholder="Ex: Le Petit Prince">
                </div>

                <div class="field">
                    <label><span class="material-icons">person</span> Auteur</label>
                    <input type="text" name="auteur" placeholder="Nom de l'auteur">
                </div>

                <div class="field">
                    <label><span class="material-icons">category</span> Genre</label>
                    <select name="genre">
                        <option value="roman">Roman</option>
                        <option value="poesie">Poésie</option>
                        <option value="science">Science-Fiction</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>

                <div class="field">
                    <label><span class="material-icons">payments</span> Prix (TND)</label>
                    <input type="number" step="0.01" name="prix" placeholder="0.00">
                </div>

                <div class="field">
                    <label><span class="material-icons">star</span> État</label>
                    <select name="condition">
                        <option value="neuf">Neuf</option>
                        <option value="bon">Bon état</option>
                        <option value="moyen">Moyen</option>
                        <option value="abimé">Abimé</option>
                    </select>
                </div>

                <div class="field full">
                    <label><span class="material-icons">description</span> Description</label>
                    <textarea name="description" placeholder="Parlez-nous un peu du livre..."></textarea>
                </div>

                <div class="field full">
                    <label><span class="material-icons">swap_horiz</span> Proposer à l'échange ?</label>
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                        <input type="checkbox" name="exchange" value="1">
                        Oui, je veux échanger ce livre
                    </label>
                </div>

                <div class="field full">
                    <label><span class="material-icons">image</span> Couverture du livre</label>
                    <div class="upload-zone" id="uploadZone">
                        <span class="material-icons">cloud_upload</span>
                        <p>Glissez votre image ici ou <strong>cliquez pour choisir</strong></p>
                        <input type="file" name="image" id="imageInput" accept="image/*">
                    </div>
                    <div class="upload-preview" id="uploadPreview">
                        <img src="" id="previewImg">
                        <button type="button" class="remove-img" id="removeImg"><span class="material-icons">close</span></button>
                    </div>
                </div>
            </div>

            <div class="form-footer">
                <button type="button" class="btn btn-secondary"
                        onclick="window.location.href='../../../pages/marketplace.php'">
                    Annuler
                </button>
                <button type="submit" class="btn btn-primary btn-submit">Publier le livre</button>
            </div>

        </form>
    </div>

</main>

<script src="../../../assets/js/main.js"></script>
<script src="../../../assets/js/publish.js"></script>
</body>
</html>