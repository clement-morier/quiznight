<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $admin = isset($_POST['admin']) ? 1 : 0;

    $sql = "INSERT INTO users (username, password, admin) VALUES ('$username', '$password', '$admin')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<?php include('templates/header.php'); ?>
<form action="register.php" method="POST">
    <?php include('templates/register_form.php'); ?>
    <div>
        <label for="admin">Admin:</label>
        <input type="checkbox" id="admin" name="admin">
    </div>
</form>
<?php include('templates/footer.php'); ?>