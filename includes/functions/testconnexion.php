<?php



require_once 'config/autoloader.php';

try {
  
    $repo = new BookRepository();
    
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