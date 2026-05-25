<?php

// 1. Charger les classes nécessaires
require_once __DIR__ . '/session.php';

// 2. Démarrer la session
Session::start();

// 3. (optionnel) charger DB plus tard
// require_once __DIR__ . '/database.php';

// 4. configs globales
if (!defined('BASE_URL')) {
    define('BASE_URL', '/projet_web/KITAB');
}