<?php
include_once '../config.php';
$db_connection = pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASS);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Уязвимый код для демонстрации SQL-инъекции
    $query = "SELECT * FROM users WHERE username = '$username' AND password = MD5('$password')";
    $result = pg_query($db_connection, $query);
    
    if (pg_num_rows($result) > 0) {
        // Успешный вход
        session_start();
        $_SESSION['user'] = pg_fetch_assoc($result);
        echo "Login successful!";
        // Здесь можно добавить перенаправление на другую страницу
        // header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<html>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="POST">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
