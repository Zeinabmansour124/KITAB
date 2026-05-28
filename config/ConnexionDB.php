<?php

class ConnexionDB
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {

            self::$instance = new PDO(
                "mysql:host=127.0.0.1;port=3307;dbname=kitab;charset=utf8",
                "root",
                ""
            );

            self::$instance->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }

        return self::$instance;
    }
}