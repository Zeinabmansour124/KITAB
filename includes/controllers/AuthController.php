<?php

require_once __DIR__ . '/../../config/models/User.php';
require_once __DIR__ . '/../../config/repositories/UserRepository.php';
require_once __DIR__ . '/../../core/session.php';

class AuthController
{
    private $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    // 📄 LOGIN PAGE
    public function showLogin()
    {
        include __DIR__ . '/../../views/auth/login.php';
    }

    // 📄 REGISTER PAGE
    public function showRegister()
    {
        include __DIR__ . '/../../views/auth/register.php';
    }

    // 🔐 LOGIN
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userRepo->findByEmail($email);

            if (!$user) {
                echo " Email introuvable";
                return;
            }

            if (!password_verify($password, $user['password'])) {
                echo " Mot de passe incorrect";
                return;
            }

            unset($user['password']);
            Session::set('user', $user);
            header('Location: /projet_web/KITAB/pages/marketplace.php');


            exit;
        }
    }

    // 📝 REGISTER
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'] ?? '';

            // 🔎 check email
            $existingUser = $this->userRepo->findByEmail($email);

            if ($existingUser) {
                echo " Email déjà utilisé";
                return;
            }

            // 🔐 hash password
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // 📸 upload image
            $imagePath = null;

            if (!empty($_FILES['profile_image']['name'])) {

                $uploadDir = __DIR__ . "/../../uploads/profiles/";

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $fileName = time() . "_" . basename($_FILES["profile_image"]["name"]);
                $targetFile = $uploadDir . $fileName;

                move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile);

                $imagePath = "uploads/profiles/" . $fileName;
            }

            // 👤 create USER object
            $user = new User(
                null,
                $_POST['name'],
                $_POST['lastname'],
                $_POST['email'],
                $imagePath,
                $hashedPassword,
                $_POST['location'],
                0.0,
                $_POST['bio']
            );

            // 💾 save
            $this->userRepo->create($user);

            header("Location: /KITAB/pages/marketplace.php");
            exit;
        }
    }

    // 🚪 LOGOUT
    public function logout()
    {
        Session::destroy();

        header("Location: /KITAB/pages/marketplace.php");
        exit;
    }
}