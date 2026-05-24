<?php
session_start();
$_SESSION['user_id'] = 1;
//session_destroy();
require_once('../../config/autoloader.php');

// 1. Vérification de l'utilisateur (Sécurité)
$isLoggedIn = isset($_SESSION['user_id']);
$error = null;
$success = null;

// 2. Gestion de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isLoggedIn) {
    try {
        $bookRepo = new BookRepository();
        
        // Gestion de l'upload d'image
        $imagePath = 'default_book.png';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $fileName = uniqid('book_') . '.' . $ext;
            
            // CORRECTION ICI : On ajoute ../../ pour sortir de includes/functions/
            move_uploaded_file($_FILES['image']['tmp_name'], '../../uploads/' . $fileName);
            
            $imagePath = $fileName; // On garde uniquement le nom du fichier pour la base de données
        }
        // Insertion dans la base via le Repository
        $bookRepo->create([
            'user_id'     => $_SESSION['user_id'],
            'titre'       => $_POST['titre'],
            'auteur'      => $_POST['auteur'],
            'prix'        => $_POST['prix'],
            'genre'       => $_POST['genre'],
            'condition'   => $_POST['condition'],
            'description' => $_POST['description'],
            'image'       => $imagePath,
            'for_exchange'=> isset($_POST['exchange']) ? 1 : 0
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
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/publish.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<div class="nav-spacer"></div>

<main class="page-body">
    <?php if (!$isLoggedIn): include('denied.php')?>
        
    <?php else: ?>
        
        <div class="form-card">
            <div class="form-card-header">
                <span class="material-icons">auto_stories</span>
                <div>
                    <h2>Publier un nouveau livre</h2>
                    <p>Remplissez les informations pour partager votre ouvrage.</p>
                </div>
            </div>

            <form action="" method="POST" enctype="multipart/form-data" class="form-body">
                
                <?php if($success): ?> <div class="alert alert-success"><?php echo $success; ?></div> <?php endif; ?>
                <?php if($error): ?> <div class="alert alert-error"><?php echo $error; ?></div> <?php endif; ?>

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
                    <button type="reset" class="btn btn-secondary" id="resetBtn">Annuler</button>
                    <button type="submit" class="btn btn-primary btn-submit">Publier le livre</button>
                </div>
            </form>
        </div>
    <?php endif; ?>
</main>

<script src="../../assets/js/main.js"></script>
<script src="../../assets/js/publish.js"></script>
</body>
</html>