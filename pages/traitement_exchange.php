<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=KITABdatabase;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = intval($_GET['id']); // Sécurisation de l'ID

    if ($action === 'accept') {
        $req = $bdd->prepare('UPDATE exchange SET status = "accepted" WHERE id = ?');
        $req->execute([$id]);
    } 
    elseif ($action === 'decline') {
        $req = $bdd->prepare('UPDATE exchange SET status = "refused" WHERE id = ?');
        $req->execute([$id]);
    }
}
header('Location: exchange.php');
exit();
?>