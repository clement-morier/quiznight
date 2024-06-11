<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['admin'] != 1) {
    header("Location: login.php");
    exit();
}

include('db.php');
include('Quiz.php');

$quiz = new Quiz($conn);

if (isset($_GET['id'])) {
    $quiz->id = $_GET['id'];
    if ($quiz->delete()) {
        header("Location: admin.php");
    } else {
        echo "Error: Could not delete quiz";
    }
}

$conn->close();
?>