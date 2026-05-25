<?php

class Session
{
    // 🔥 Démarrer la session (obligatoire au début de chaque requête)
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // 💾 Stocker une valeur dans la session
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    // 📥 Récupérer une valeur
    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    // ❌ Supprimer une clé spécifique
    public static function remove($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    // 🔐 Vérifier si utilisateur connecté
    public static function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    // 👤 Récupérer l'utilisateur connecté
    public static function getUser()
    {
        return $_SESSION['user'] ?? null;
    }

    // 🚪 Logout complet
    public static function destroy()
    {
        session_unset();
        session_destroy();
    }
}
