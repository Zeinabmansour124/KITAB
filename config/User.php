<?php
class User extends UserRepository {
    public function __construct(
        public $id = null,
        public $nom = "",
        public $prenom = "",
        public $email = "",
        public $avatar = ""
    ) {}
    public function getUserImage($id) {
        $this->db->prepare("SELECT image FROM users WHERE id = :id");
        $this->db->execute(['id' => $id]);
        return $this->db->fetchColumn();
    }
    public function getUserName($id) {
        $this->db->prepare("SELECT nom FROM users WHERE id = :id");
        $this->db->execute(['id' => $id]);
        return $this->db->fetchColumn();
    }
    public function getUserLocation($id) {
        $this->db->prepare("SELECT location FROM users WHERE id = :id");
        $this->db->execute(['id' => $id]);
        return $this->db->fetchColumn();
    }
    
    
}