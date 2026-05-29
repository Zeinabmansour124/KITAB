<?php

require_once __DIR__ . '/../../config/models/User.php';
require_once __DIR__ . '/../../config/models/repositories/UserRepository.php';
require_once __DIR__ . '/../../core/session.php';

class AuthController
{
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

  
    public function showLogin()
    {
        include __DIR__ . '/../../views/auth/login.php';
    }

 
    public function showRegister()
    {
        include __DIR__ . '/../../views/auth/register.php';
    }


    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $this->userRepo->findByEmail($email);

        if (!$user) {
            echo "Email introuvable";
            return;
        }

        if (!password_verify($password, $user['password'])) {
            echo "Mot de passe incorrect";
            return;
        }

        unset($user['password']);

        Session::set('user', $user);

        header("Location: /projet_web/KITAB/pages/marketplace.php");
        exit;
    }


    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $email = trim($_POST['email'] ?? '');

       
        if ($this->userRepo->findByEmail($email)) {
            echo "Email déjà utilisé";
            return;
        }

       
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

      
        $avatarPath = null;

        if (!empty($_FILES['avatar']['name'])) {

            $uploadDir = __DIR__ . "/../../uploads/profiles/";

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . "_" . basename($_FILES["avatar"]["name"]);
            $targetFile = $uploadDir . $fileName;

            move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile);

            $avatarPath = "uploads/profiles/" . $fileName;
        }

    
        $user = new User(
            null,
            $_POST['nom'] ?? '',
            $_POST['prenom'] ?? '',
            $email,
            $hashedPassword,
            $avatarPath,
            $_POST['bio'] ?? '',
            null
        );


        $this->userRepo->create($user);

        header("Location: /projet_web/KITAB/pages/marketplace.php");
        exit;
    }


    public function logout()
    {
        Session::destroy();

        header("Location: /projet_web/KITAB/pages/marketplace.php");
        exit;
    }
}