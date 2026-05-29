<?php

require_once __DIR__ . '/../../ConnexionDB.php';

class UserRepository
{
    private $db;

    public function __construct()
    {
        $this->db = ConnexionDB::getInstance();
    }

    // 🔐 FIND USER BY EMAIL
    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM users WHERE email = :email
        ");

        $stmt->execute([
            'email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 👤 FIND USER BY ID
    public function findById($id)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM users WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ➕ CREATE USER
    public function create(User $user)
    {
        $stmt = $this->db->prepare("
            INSERT INTO users (
                nom,
                prenom,
                email,
                password,
                avatar,
                bio
            )
            VALUES (
                :nom,
                :prenom,
                :email,
                :password,
                :avatar,
                :bio
            )
        ");

        return $stmt->execute([
            'nom' => $user->nom,
            'prenom' => $user->prenom,
            'email' => $user->email,
            'password' => $user->password,
            'avatar' => $user->avatar,
            'bio' => $user->bio
        ]);
    }

    // 🖼 GET USER AVATAR
    public function getUserAvatar($id)
    {
        $stmt = $this->db->prepare("SELECT avatar FROM users WHERE id = :id");

        $stmt->execute([
            'id' => $id
        ]);

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result ? $result->avatar : "default.png";
    }

    // 👤 FULL NAME
    public function getUserName($id)
    {
        $stmt = $this->db->prepare("SELECT CONCAT(prenom, ' ', nom) AS fullname FROM users WHERE id = :id");

        $stmt->execute([
            'id' => $id
        ]);

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result ? $result->fullname : "Unknown User";
    }
    public function countBooksByUser($userId)
    {
        $stmt = $this->db->prepare("
        SELECT COUNT(*) 
        FROM books 
        WHERE user_id = :id
    ");

        $stmt->execute([
            'id' => $userId
        ]);

        return $stmt->fetchColumn();
    }
    public function countFavoritesByUser($userId)
    {
        $stmt = $this->db->prepare("
        SELECT COUNT(*) 
        FROM favorites 
        WHERE user_id = :id
    ");

        $stmt->execute([
            'id' => $userId
        ]);

        return $stmt->fetchColumn();
    }

    public function getUserRate($userId)
    {
        $stmt = $this->db->prepare("
            SELECT AVG(rate) AS average_rate 
            FROM reviews 
            WHERE user_id = :id
        ");

        $stmt->execute([
            'id' => $userId
        ]);

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result ? round($result->average_rate, 2) : 0;
    }
}