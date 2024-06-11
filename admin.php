<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['admin'] != 1) {
    header("Location: login.php");
    exit();
}

include('db.php');
include('Quiz.php');

$quiz = new Quiz($conn);
$quizzes = $quiz->getAll();

$conn->close();
?>

<?php include('templates/header.php'); ?>
<h2>Admin Page</h2>
<a href="create_quiz.php">Create New Quiz</a>
<table>
    <tr>
        <th>Quiz Title</th>
        <th>Created By</th>
        <th>Actions</th>
    </tr>
    <?php while($row = $quizzes->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['created_by']; ?></td>
            <td>
                <a href="edit_quiz.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete_quiz.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<?php include('templates/footer.php'); ?>