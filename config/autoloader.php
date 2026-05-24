<?php
spl_autoload_register(function ($className) {
    $paths = [
        __DIR__ . '/repositories/',
        __DIR__ . '/../models/',
        __DIR__ . '/',
    ];
    foreach ($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) { include_once $file; return; }
    }
});
