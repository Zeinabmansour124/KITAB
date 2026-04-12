<?php
include_once 'config/Repository.php';  // Chemin corrigé (slash, pas backslash)
class UserRepository extends Repository {
    public function __construct() {
        parent::__construct('users');
    }
}