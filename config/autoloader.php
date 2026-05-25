<?php
require_once __DIR__ . '/ConnexionDB.php';
require_once __DIR__ . '/IRepository.php';
require_once __DIR__ . '/Repository.php';

spl_autoload_register(function ($className) {
    $paths = [
        __DIR__ . '/models/repositories/',
        __DIR__ . '/models/',
        __DIR__ . '/',
    ];
    foreach ($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) { include_once $file; return; }
    }
});