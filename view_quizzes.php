<?php
include('db.php');

$sql = "SELECT * FROM quizzes";
$result = $conn->query($sql);

$conn->close();
?>

<?php include('templates/header.php'); ?>
<h2>Available Quizzes</h2>
<table>
    <tr>
        <th>Quiz Title</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>
<?php include('templates/footer.php'); ?>   