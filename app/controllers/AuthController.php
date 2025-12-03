<?php
class AuthController {

    protected $user;

    public function __construct($db) {
        $this->user = new UserModel($db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $hasil = $this->user->login($_POST['username'], $_POST['password']);

            if ($hasil) {
                $_SESSION['user'] = $hasil;
                header("Location: index.php");
                exit;
            } else {
                $error = "Username atau password salah.";
            }
        }
        include "../public/login.php";
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->user->register($_POST);
            header("Location: login.php");
            exit;
        }

        include "../public/register.php";
    }

    public function logout() {
        session_destroy();
        header("Location: login.php");
    }
}
