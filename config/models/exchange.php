<?php
require_once __DIR__ . '/repositories/BookRepository.php'; 
require_once __DIR__ . '/../ConnexionDB.php'; // 🚀 Corrigé : un seul dossier de recul pour sortir de models/

class exchange {

    private $db;

    public function __construct() {
        $this->db = ConnexionDB::getInstance();
    }

    public function count_all($userId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM exchanges WHERE user_requesting_id = :uid OR user_offering_id = :uid2");
        $stmt->execute(['uid' => $userId, 'uid2' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? (int)$result->count : 0;
    }

    public function count_completed($userId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM exchanges WHERE (user_requesting_id = :uid OR user_offering_id = :uid2) AND status = 'completed'");
        $stmt->execute(['uid' => $userId, 'uid2' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? (int)$result->count : 0;
    }

    public function count_active($userId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM exchanges WHERE (user_requesting_id = :uid OR user_offering_id = :uid2) AND status IN ('accepted','in_progress')");
        $stmt->execute(['uid' => $userId, 'uid2' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? (int)$result->count : 0;
    }

    public function count_refused($userId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM exchanges WHERE (user_requesting_id = :uid OR user_offering_id = :uid2) AND status = 'refused'");
        $stmt->execute(['uid' => $userId, 'uid2' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? (int)$result->count : 0;
    }

    public function recuperer_donnees($userId) {
        $stmt = $this->db->prepare("SELECT * FROM exchanges WHERE (user_requesting_id = :uid OR user_offering_id = :uid2) AND status = 'completed' ORDER BY created_at DESC");
        $stmt->execute(['uid' => $userId, 'uid2' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function recuperer_accepted($userId) {
        $stmt = $this->db->prepare("SELECT * FROM exchanges WHERE (user_requesting_id = :uid OR user_offering_id = :uid2) AND status = 'accepted' ORDER BY created_at DESC");
        $stmt->execute(['uid' => $userId, 'uid2' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function recuperer_pending($userId) {
        $stmt = $this->db->prepare("SELECT * FROM exchanges WHERE user_requesting_id = :uid AND status = 'pending' ORDER BY created_at DESC");
        $stmt->execute(['uid' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function recuperer_progress($userId) {
        $stmt = $this->db->prepare("SELECT * FROM exchanges WHERE (user_requesting_id = :uid OR user_offering_id = :uid2) AND status = 'in_progress' ORDER BY created_at DESC");
        $stmt->execute(['uid' => $userId, 'uid2' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function recuperer_refused($userId) {
        $stmt = $this->db->prepare("SELECT * FROM exchanges WHERE (user_requesting_id = :uid OR user_offering_id = :uid2) AND status = 'refused' ORDER BY created_at DESC");
        $stmt->execute(['uid' => $userId, 'uid2' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}