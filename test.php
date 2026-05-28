<?php

try {

    $pdo = new PDO(
        "mysql:host=127.0.0.1;port=3307;dbname=kitab;charset=utf8",
        "root",
        ""
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connexion réussie ✅";

} catch (PDOException $e) {

    die("Erreur connexion : " . $e->getMessage());
}
