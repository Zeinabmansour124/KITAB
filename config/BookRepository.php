<?php
class BookRepository extends Repository {
    public function __construct() {
        parent::__construct('books');
    }
    
    // Exemple d'une méthode spécifique
    public function findByGenre($genre) {
        $req = $this->db->prepare("SELECT * FROM books WHERE genre = ?");
        $req->execute([$genre]);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
}