<?php
class AuthController {

    protected $user;

    public function __construct($db) {
        $this->user = new UserModel($db);
        session_start();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $hasil = $this->user->login($_POST['username'], $_POST['password']);

            if ($hasil) {
                // Simpan user ke session
                $_SESSION['user'] = $hasil;

                // CEK ROLE USER
                if ($hasil['role'] === 'admin') {
                    header("Location: ../public/admin_jadwal.php");  // dashboard admin
                    exit;
                } else {
                    header("Location: ../public/dashboard.php");     // dashboard user
                    exit;
                }

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
