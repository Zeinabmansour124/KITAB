<?php
class Book {
    public function __construct(
        public $id = null,
        public $titre = "",
        public $auteur = "",
        public $prix = 0,
        public $genre = ""
    ) {}
}