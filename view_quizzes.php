<?php
include('db.php');
include('Quiz.php');

$quiz = new Quiz($conn);
$quizzes = $quiz->getAll();

$conn->close();
?>

<?php include('templates/header.php'); ?>
<h2>Available Quizzes</h2>
<table>
    <tr>
        <th>Quiz Title</th>
        <th>Created By</th>
    </tr>
    <?php while($row = $quizzes->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['created_by']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>
<?php include('templates/footer.php'); ?>