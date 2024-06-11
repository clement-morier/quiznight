<?php
include('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['admin'] = $row['admin'];
            header("Location: admin.php");
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found";
    }
}

$conn->close();
?>

<?php include('templates/header.php'); ?>
<form action="login.php" method="POST">
    <?php include('templates/login_form.php'); ?>
</form>
<?php include('templates/footer.php'); ?>