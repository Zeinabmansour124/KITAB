<?php


require_once __DIR__ . '/../../config/autoloader.php';

echo "<h1 style='font-family: sans-serif; color: #1a1208;'>Test de connexion KITAB</h1>";

try {
    
    $db = ConnexionDB::getInstance(); 
    
    echo "<div style='padding: 15px; background-color: #d4edda; color: #155724; border-radius: 5px; font-family: sans-serif; margin-bottom: 20px;'>";
    echo "✅ <strong>Connexion à la base de données réussie !</strong><br>";
    echo "L'instance PDO a été créée avec succès. Le projet KITAB communique parfaitement avec MySQL sur le port 3307.";
    echo "</div>";

    
    $repo = new BookRepository();
    $livres = $repo->findAll();
    
    echo "<h3 style='font-family: sans-serif;'> Vérification de la table 'books' :</h3>";
    if (empty($livres)) {
        echo "<p style='font-family: sans-serif; color: #666;'>La connexion fonctionne, mais aucun livre n'a été trouvé dans la table.</p>";
    } else {
        echo "<p style='font-family: sans-serif;'><strong>" . count($livres) . " livres</strong> récupérés avec succès !</p>";
        echo "<pre style='background: #f4f4f4; padding: 15px; border-radius: 5px; border: 1px solid #ccc; max-height: 300px; overflow-y: auto; font-family: monospace;'>";
        echo "Exemple du premier livre en base de données :<br><br>";
        print_r($livres[0]); 
        echo "</pre>";
    }

} catch (PDOException $e) {
    
    echo "<div style='padding: 15px; background-color: #f8d7da; color: #721c24; border-radius: 5px; font-family: sans-serif;'>";
    echo "<h3>❌ Erreur de Connexion PDO</h3>";
    echo "<strong>Message :</strong> " . htmlspecialchars($e->getMessage()) . "<br><br>";
    echo "💡 <em>Vérifie que ton module MySQL sur XAMPP est bien démarré sur le port 3307.</em>";
    echo "</div>";
} catch (Exception $e) {
    
    echo "<div style='padding: 15px; background-color: #fff3cd; color: #856404; border-radius: 5px; font-family: sans-serif;'>";
    echo "<h3>⚠️ Erreur d'exécution PHP</h3>";
    echo "<strong>Message :</strong> " . htmlspecialchars($e->getMessage()) . "</div>";
}