<?php
class UserModel {

    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password']))
            return $user;

        return false;
    }

    public function register($data) {
        $stmt = $this->db->prepare("INSERT INTO users (nama, username, password) VALUES (?,?,?)");
        return $stmt->execute([
            $data['nama'],
            $data['username'],
            password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }
}
