<?php

require_once __DIR__ . '/../../ConnexionDB.php';

class UserRepository
{
    private $db;

    public function __construct()
    {
        $this->db = ConnexionDB::getInstance();
    }

    // 🔐 FIND USER BY EMAIL (LOGIN)
    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 👤 FIND USER BY ID
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ➕ CREATE USER (REGISTER)
    public function create(User $user)
    {
        $stmt = $this->db->prepare("
            INSERT INTO users (nom, prenom, email, password, image, location, bio, rate)
            VALUES (:nom, :prenom, :email, :password, :image, :location, :bio, :rate)
        ");

        return $stmt->execute([
            'nom' => $user->nom,
            'prenom' => $user->prenom,
            'email' => $user->email,
            'password' => $user->password,
            'image' => $user->image,
            'location' => $user->location,
            'bio' => $user->bio,
            'rate' => $user->rate
        ]);
    }

    // 🖼 GET IMAGE
    public function getUserImage($id)
    {
        $stmt = $this->db->prepare("SELECT image FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result ? $result->image : "default.png";
    }

    // 👤 FULL NAME
    public function getUserName($id)
    {
        $stmt = $this->db->prepare("SELECT CONCAT(prenom, ' ', nom) AS fullname FROM users WHERE id = :id");

        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result ? $result->fullname : "Unknown User";
    }
}