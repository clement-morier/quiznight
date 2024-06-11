<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['admin'] != 1) {
    header("Location: login.php");
    exit();
}

include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $created_by = $_SESSION['username'];

    $sql = "INSERT INTO quizzes (title, created_by, question, answer) VALUES ('$title', '$created_by', '$question', '$answer')";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<?php include('templates/header.php'); ?>
<form action="create_quiz.php" method="POST">
    <?php include('templates/admin_form.php'); ?>
</form>
<?php include('templates/footer.php'); ?>