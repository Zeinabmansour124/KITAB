<?php
require_once __DIR__ . '/../repositories/UserRepository.php';

class User extends UserRepository {

    public function __construct(
        public $id     = null,
        public $nom    = "",
        public $prenom = "",
        public $email  = "",
        public $avatar = ""
    ) {}

    public function getUserImage($id) {
        $stmt = $this->db->prepare("SELECT avatar FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? $result->avatar : "default.png";
    }

    public function getUserName($id) {
        $stmt = $this->db->prepare("SELECT CONCAT(prenom, ' ', nom) as fullname FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? $result->fullname : "Unknown User";
    }

    public function getUserLocation($id) {
        return "";
    }

    public function getUserRating($id) {
        return 0;
    }
}