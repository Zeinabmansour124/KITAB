<?php


require_once __DIR__ . '/session.php';

Session::start();

if (!defined('BASE_URL')) {
    define('BASE_URL', '/projet_web/KITAB');
}