<?php
class Book extends Repository{
    public function __construct(
        public $id = null,
        public $titre = "",
        public $auteur = "",
        public $prix = 0,
        public $genre = ""
    ) {}
    public function getBooktitle($bookId) {
        $db = ConnexionDB::getInstance();
        $stmt = $db->prepare("SELECT titre FROM book WHERE id = :id");
        $stmt->execute(['id' => $bookId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? $result->titre : "Unknown Title";
    }
    public function getBookAuthor($bookId) {
        $db = ConnexionDB::getInstance();
        $stmt = $db->prepare("SELECT auteur FROM book WHERE id = :id");
        $stmt->execute(['id' => $bookId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? $result->auteur : "Unknown Author";
    }
    public function getBookCondition($bookId) {
        $db = ConnexionDB::getInstance();
        $stmt = $db->prepare("SELECT `condition` FROM book WHERE id = :id");
        $stmt->execute(['id' => $bookId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? $result->condition : "Unknown Condition";
    }
}