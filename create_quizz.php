<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['admin'] != 1) {
    header("Location: login.php");
    exit();
}

include('db.php');
include('Quiz.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quiz = new Quiz($conn);
    $quiz->title = $_POST['title'];
    $quiz->question = $_POST['question'];
    $quiz->answer = $_POST['answer'];
    $quiz->created_by = $_SESSION['username'];

    if ($quiz->create()) {
        header("Location: admin.php");
    } else {
        echo "Error: Could not create quiz";
    }
}

$conn->close();
?>

<?php include('templates/header.php'); ?>
<form action="create_quiz.php" method="POST">
    <?php include('templates/admin_form.php'); ?>
</form>
<?php include('templates/footer.php'); ?>