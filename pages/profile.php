<?php
require_once __DIR__ . '/../core/auth_middelware.php';
require_once __DIR__ . '/../config/models/repositories/UserRepository.php';

$userRepo = new UserRepository();

if (!isset($_SESSION['user'])) {
    header("Location: /projet_web/KITAB/includes/controllers/index.php?page=login");
    exit;
}

$userId = $_SESSION['user']['id'];
$user = $userRepo->findById($userId);


$booksCount = $userRepo->countBooksByUser($userId);
$favCount   = $userRepo->countFavoritesByUser($userId);

$pageTitle = "My Profile - KITAB";
$pageCSS   = "profile.css";
var_dump($favCount);
?>

<!DOCTYPE html>
<html lang="en">

<?php require('../includes/components/head.php'); ?>

<body>

<?php require('../includes/components/bar.php'); ?>

<div class="page-wrapper">

    <div class="profile-container">

        <div class="profile-card">

            <!-- AVATAR -->
            <div class="profile-avatar">
                <img src="/projet_web/KITAB/uploads/<?= htmlspecialchars($user['avatar'] ?? 'default.png') ?>" />
            </div>

            <!-- INFO -->
            <div class="profile-info">
                <h1><?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?></h1>
                <p class="bio"><?= htmlspecialchars($user['bio'] ?? 'No bio yet...') ?></p>
                <p class="email"><?= htmlspecialchars($user['email']) ?></p>
            </div>

            <!-- STATS -->
            <div class="profile-stats">

                <div class="stat">
                    <h2><?= $booksCount ?></h2>
                    <span>Books</span>
                </div>

                <div class="stat">
                    <h2><?= $favCount ?></h2>
                    <span>Favorites</span>
                </div>

            </div>

            <!-- EDIT -->
            <a class="btn-edit" href="/projet_web/KITAB/pages/edit_profile.php">
                Edit Profile
            </a>

        </div>

    </div>

</div>

</body>
</html>