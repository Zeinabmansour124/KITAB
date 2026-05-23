<?php
include_once __DIR__ . '/../Repository.php';

class UserRepository extends Repository {
    public function __construct() {
        parent::__construct('users');
    }
}