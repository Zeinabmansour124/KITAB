<?php
include_once __DIR__ . '/../config/Repository.php';
class UserRepository extends Repository {
    public function __construct() {
        parent::__construct('users');
    }
}