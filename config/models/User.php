<?php

require_once __DIR__ . '/repositories/UserRepository.php';

class User {

    private $userRepository;

    public function __construct(
        public $id = null,
        public $nom = "",
        public $prenom = "",
        public $email = "",
        public $password = "",
        public $avatar = "",
        public $bio = "",
        public $created_at = null,
        public $rate=0
    ) {

        $this->userRepository = new UserRepository();
    }



    /**
     * Nom complet
     */
    public function getUserName($userId) {

        return $this->userRepository->getUserName($userId);
    }

    /**
     * Avatar utilisateur
     */
    public function getUserAvatar($userId) {

        return $this->userRepository->getUserAvatar($userId);
    }

    /**
     * Note de l'utilisateur
     */
    public function getUserRate($userId) {

        return $this->userRepository->getUserRate($userId);
    }
}