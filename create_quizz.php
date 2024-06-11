<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $questions = $_POST['questions'];

    $sql = "INSERT INTO quizzes (title, questions) VALUES ('$title', '$questions')";

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