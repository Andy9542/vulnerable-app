<?php
session_start();
include_once '../config.php';

// Если пользователь уже авторизован, перенаправляем его на главную страницу
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$db_connection = pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASS);

$message = '';

function register($username, $password, $email) {
    global $db_connection;
    $hashed_password = md5($password); // Использование MD5 вместо более безопасных методов
    $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
    return pg_query($db_connection, $query);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    if (register($username, $password, $email)) {
        $message = "Registration successful. You can now <a href='login.php'>login</a>.";
    } else {
        $message = "Registration failed. Please try again.";
    }
}
?>

<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="POST">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        Email: <input type="email" name="email" required><br>
        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
