<?php

class Session
{
    
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

   
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

   
    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

   
    public static function remove($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

  
    public static function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

  
    public static function getUser()
    {
        return $_SESSION['user'] ?? null;
    }


    public static function destroy()
    {
        session_unset();
        session_destroy();
    }
}
