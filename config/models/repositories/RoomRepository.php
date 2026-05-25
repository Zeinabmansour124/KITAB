<?php
require_once __DIR__ . '/../../Repository.php'; // 🚀 Corrigé : remonte proprement de deux niveaux pour retrouver la racine config/

class RoomRepository extends Repository {
    public function __construct() {
        parent::__construct('reading_rooms');
    }

    public function findByType(string $type): array {
        $req = $this->db->prepare(
            "SELECT * FROM reading_rooms WHERE type = ? ORDER BY created_at DESC"
        );
        $req->execute([$type]);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
}