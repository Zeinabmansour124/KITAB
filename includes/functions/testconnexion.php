<?php
// 1. On active l'affichage des erreurs pour le débug
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. On charge l'autoloader
require_once 'config/autoloader.php';

try {
    // 3. On instancie le repository des livres
    $repo = new BookRepository();
    
    // 4. On récupère tous les livres
    $livres = $repo->findAll();
    
    echo "<h1>Test de connexion KITAB</h1>";
    echo "✅ Connexion à la base de données réussie !<br><br>";
    
    echo "<h3>Contenu de la table 'books' :</h3>";
    echo "<pre>";
    var_dump($livres); // Affiche la structure des données récupérées
    echo "</pre>";

} catch (Exception $e) {
    echo "<h1>❌ Erreur</h1>";
    echo "Détails : " . $e->getMessage();
}