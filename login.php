<?php
include('db.php');
include('User.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User($conn);
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    if ($user->login()) {
        $_SESSION['username'] = $user->username;
        $_SESSION['admin'] = $user->admin;
        header("Location: admin.php");
    } else {
        echo "Invalid credentials";
    }
}

$conn->close();
?>

<?php include('templates/header.php'); ?>
<form action="login.php" method="POST">
    <?php include('templates/login_form.php'); ?>
</form>
<?php include('templates/footer.php'); ?>