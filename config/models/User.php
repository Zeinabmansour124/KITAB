<?php
require_once __DIR__ . '/repositories/UserRepository.php';


class User {

    public function __construct(
        public $id     = null,
        public $nom    = "",
        public $prenom = "",
        public $email  = "",
        public $image = "",
        public $password = "",
        public $location="",
        public $rate=0.00,
        public $bio=""


    ) {}


}