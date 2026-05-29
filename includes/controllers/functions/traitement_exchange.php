<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: connect.php');
    exit();
}

try {
    $bdd = new PDO('mysql:host=localhost;dbname=kitab;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = intval($_GET['id']);
    $userId = $_SESSION['user']['id'];

    if ($action === 'accept') {
        $req = $bdd->prepare('UPDATE exchanges SET status = "accepted" WHERE id = ? AND user_offering_id = ?');
        $req->execute([$id, $userId]);
    } 
    elseif ($action === 'decline') {
        $req = $bdd->prepare('UPDATE exchanges SET status = "refused" WHERE id = ? AND user_offering_id = ?');
        $req->execute([$id, $userId]);
    }
}

header('Location: exchangePage.php');
exit();
?>