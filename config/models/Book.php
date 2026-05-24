<?php
require_once __DIR__ . '/../repositories/BookRepository.php';

class Book extends BookRepository {

    public function __construct(
        public $id     = null,
        public $titre  = "",
        public $auteur = "",
        public $prix   = 0,
        public $genre  = ""
    ) {}

    public function getbooktitle($bookId) {
        $stmt = $this->db->prepare("SELECT titre FROM books WHERE id = :id");
        $stmt->execute(['id' => $bookId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? $result->titre : "Unknown Title";
    }

    public function getBookAuthor($bookId) {
        $stmt = $this->db->prepare("SELECT auteur FROM books WHERE id = :id");
        $stmt->execute(['id' => $bookId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? $result->auteur : "Unknown Author";
    }

    public function getBookCondition($bookId) {
        $stmt = $this->db->prepare("SELECT `condition` FROM books WHERE id = :id");
        $stmt->execute(['id' => $bookId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? $result->condition : "Unknown";
    }

    public function getBookCover($bookId) {
        $stmt = $this->db->prepare("SELECT image FROM books WHERE id = :id");
        $stmt->execute(['id' => $bookId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? $result->image : "default.jpg";
    }
}