<?php
// Configuration exacte tirée de ton image
$dsn  = "mysql:host=127.0.0.1;port=3307;dbname=kitab;charset=utf8";
$user = "root";
$pass = ""; 

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    // Connexion sur le port 3307
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Code SQL pour recréer la table proprement
    $sql = "DROP TABLE IF EXISTS users;
            CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nom VARCHAR(100) NOT NULL,
                prenom VARCHAR(100) NOT NULL,
                email VARCHAR(150) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL,
                avatar VARCHAR(255) DEFAULT 'default.png',
                bio TEXT NULL
            );";
            
    $pdo->exec($sql);
    echo "<h1 style='color:green; font-family:sans-serif;'>🎉 Base de données réparée avec succès sur le port 3307 !</h1>";
    echo "<p>La table <strong>users</strong> a été créée avec la colonne <strong>avatar</strong>.</p>";
    echo "<p>Tu peux maintenant retourner sur ton formulaire d'inscription, tout va fonctionner !</p>";

} catch (\PDOException $e) {
    echo "<h1 style='color:red; font-family:sans-serif;'>❌ Erreur de connexion</h1>";
    echo "<p>Message : " . $e->getMessage() . "</p>";
}
