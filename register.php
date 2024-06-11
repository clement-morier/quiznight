<?php
include('db.php');
include('User.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User($conn);
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];
    $user->admin = isset($_POST['admin']) ? 1 : 0;

    if ($user->register()) {
        header("Location: login.php");
    } else {
        echo "Error: Registration failed";
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