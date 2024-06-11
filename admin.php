<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['admin'] != 1) {
    header("Location: login.php");
    exit();
}

include('db.php');

$sql = "SELECT * FROM quizzes";
$result = $conn->query($sql);

$conn->close();
?>

<?php include('templates/header.php'); ?>
<h2>Admin Page</h2>
<a href="create_quiz.php">Create New Quiz</a>
<table>
    <tr>
        <th>Quiz Title</th>
        <th>Actions</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td>
                <a href="edit_quiz.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete_quiz.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<?php include('templates/footer.php'); ?>