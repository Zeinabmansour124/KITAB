<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /projet_web/KITAB/views/auth/login.php");
    exit;
}
