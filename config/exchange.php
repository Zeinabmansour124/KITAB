<?php
include_once 'config/Repository.php';  // Chemin corrigé (slash, pas backslash)

class Exchange extends Repository {  // Nom de classe avec majuscule (convention)
    
    public function __construct() {
        parent::__construct("exchange");  // Nom de la table en paramètre
    }
    
    public function count_All($userId) {  // Nom de méthode en camelCase
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM exchange WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? $result->count : 0;
    }
    
    /**
     * Compter les échanges complétés d'un utilisateur
     */
    public function count_Completed($userId) {  // camelCase
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM exchange WHERE user_id = :user_id AND completed = 'yes'");
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? $result->count : 0;
    }
    
    /**
     * Compter les échanges actifs d'un utilisateur
     */
    public function count_Active($userId) {  // camelCase
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM exchange WHERE user_id = :user_id AND completed = 'no'");
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? $result->count : 0;
    }
    
    /**
     * Récupérer tous les échanges d'un utilisateur
     */
    public function recuperer_Donnees($userId) {  // Nom sans accent + camelCase
        $stmt = $this->db->prepare("SELECT * FROM exchange WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function recuperer_Accepted($userId) {  // Nom sans accent + camelCase
            $stmt = $this->db->prepare("SELECT * FROM exchange WHERE user_id = :user_id AND accepted = 1");
            $stmt->execute(['user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    public function recuperer_Pending($userId) {  
            $stmt = $this->db->prepare("SELECT * FROM exchange WHERE user_id = :user_id AND accepted = 0");
            $stmt->execute(['user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
}
