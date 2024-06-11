<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['admin'] != 1) {
    header("Location: login.php");
    exit();
}

include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    $sql = "UPDATE quizzes SET title='$title', question='$question', answer='$answer' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM quizzes WHERE id='$id'";
    $result = $conn->query($sql);
    $quiz = $result->fetch_assoc();
}

$conn->close();
?>

<?php include('templates/header.php'); ?>
<form action="edit_quiz.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $quiz['id']; ?>">
    <?php include('templates/admin_form.php'); ?>
</form>
<?php include('templates/footer.php'); ?>