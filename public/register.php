<?php
// /var/www/vulnerable-app/public/register.php
include_once '../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    if (register($username, $password, $email)) {
        header('Location: login.php');
        exit;
    } else {
        $error = "Registration failed";
    }
}
?>
<html>
<body>
    <h2>Register</h2>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form method="POST">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        Email: <input type="email" name="email"><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
