<?php
require_once __DIR__ . '/repositories/UserRepository.php';

class User {

    private $userRepository;

    public function __construct(
        public $id       = null,
        public $nom      = "",
        public $prenom   = "",
        public $email    = "",
        public $image    = "",
        public $password = "",
        public $location = "",
        public $rate     = 0.00,
        public $bio      = ""
    ) {
        // On instancie le repository existant
        $this->userRepository = new UserRepository();
    }
    
    /**
     * Récupère le nom complet via le Repository
     */
    public function getUserName($userId) {
        return $this->userRepository->getUserName($userId);
    }

    /**
     * Récupère l'image de profil via le Repository
     */
    public function getUserImage($userId) {
        return $this->userRepository->getUserImage($userId);
    }

    /**
     * Récupère la note (rating) de l'utilisateur
     */
    public function getUserRating($userId) {
        // Comme findById renvoie un tableau (FETCH_ASSOC) dans ton repository :
        $userData = $this->userRepository->findById($userId);
        
        if ($userData && isset($userData['rate'])) {
            return round($userData['rate']);
        }
        return 0;
    }
}