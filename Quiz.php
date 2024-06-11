<?php
class Quiz {
    private $conn;
    private $table = 'quizzes';

    public $id;
    public $title;
    public $created_by;
    public $question;
    public $answer;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $sql = "INSERT INTO " . $this->table . " (title, created_by, question, answer) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssss', $this->title, $this->created_by, $this->question, $this->answer);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $sql = "UPDATE " . $this->table . " SET title = ?, question = ?, answer = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssi', $this->title, $this->question, $this->answer, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAll() {
        $sql = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($sql);
        return $result;
    }

    public function getById() {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>