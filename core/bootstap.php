<?php

// 1. Charger les classes nécessaires
require_once __DIR__ . '/session.php';   // 👈 ton fichier session.php

// 2. Démarrer la session
session::start();  // 👈 classe avec s minuscule comme tu veux

// 3. (optionnel) charger DB plus tard
// require_once __DIR__ . '/database.php';

// 4. configs globales
define('BASE_URL', '/projet_web/KITAB');