<?php
class User {
    public function __construct(
        public $id = null,
        public $nom = "",
        public $prenom = "",
        public $email = "",
        public $avatar = ""
    ) {}
}