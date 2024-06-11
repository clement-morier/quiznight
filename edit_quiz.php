<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['admin'] != 1) {
    header("Location: login.php");
    exit();
}

include('db.php');
include('Quiz.php');

$quiz = new Quiz($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quiz->id = $_POST['id'];
    $quiz->title = $_POST['title'];
    $quiz->question = $_POST['question'];
    $quiz->answer = $_POST['answer'];

    if ($quiz->update()) {
        header("Location: admin.php");
    } else {
        echo "Error: Could not update quiz";
    }
} else {
    $quiz->id = $_GET['id'];
    $quiz_data = $quiz->getById();
}

$conn->close();
?>

<?php include('templates/header.php'); ?>
<form action="edit_quiz.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $quiz_data['id']; ?>">
    <?php include('templates/admin_form.php'); ?>
</form>
<?php include('templates/footer.php'); ?>