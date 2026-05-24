<?php
class ConnexionDB {
    private static $_bdd = null;

    private function __construct() {}

    public static function getInstance() {
        if (self::$_bdd === null) {
            try {
                
                $host = "127.0.0.1";
                $port = "3307"; 
                $dbname = "kitab";
                $user = "root";
                $pass = ""; 

                self::$_bdd = new PDO(
                    "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8",
                    $user,
                    $pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                    ]
                );
            } catch (Exception $e) {
                die("Erreur de connexion (Port 3307) : " . $e->getMessage());
            }
        }
        return self::$_bdd;
    }
}