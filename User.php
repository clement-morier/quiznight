<?php
class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $username;
    public $password;
    public $admin;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register() {
        $sql = "INSERT INTO " . $this->table . " (username, password, admin) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        
        $stmt->bind_param('ssi', $this->username, $this->password, $this->admin);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login() {
        $sql = "SELECT * FROM " . $this->table . " WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $this->username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($this->password, $user['password'])) {
            $this->id = $user['id'];
            $this->username = $user['username'];
            $this->admin = $user['admin'];
            return true;
        }
        return false;
    }
}
?>