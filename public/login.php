<?php
session_start();
include_once '../config.php';
$db_connection = pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASS);

// Установка времени жизни сессии (1 час)
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);

// Функция для безопасного выхода
function logout() {
    $_SESSION = array();
    session_destroy();
    header("Location: login.php");
    exit;
}

// Обработка выхода
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    logout();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Уязвимый код для демонстрации SQL-инъекции
    $query = "SELECT * FROM users WHERE username = '$username' AND password = MD5('$password')";
    $result = pg_query($db_connection, $query);
    
    if (pg_num_rows($result) > 0) {
        // Успешный вход
        $_SESSION['user'] = pg_fetch_assoc($result);
        $_SESSION['last_activity'] = time();
        echo "Login successful!";
        // Перенаправление на эту же страницу для отображения информации о пользователе
        header("Location: login.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}

// Проверка времени последней активности
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
    logout();
}

// Обновление времени последней активности
if (isset($_SESSION['user'])) {
    $_SESSION['last_activity'] = time();
}
?>

<html>
<body>
    <?php if (isset($_SESSION['user'])): ?>
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>!</h2>
        <p>Your role: <?php echo htmlspecialchars($_SESSION['user']['role']); ?></p>
        <a href="login.php?action=logout">Logout</a>
    <?php else: ?>
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <form method="POST">
            Username: <input type="text" name="username"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit" value="Login">
        </form>
    <?php endif; ?>
</body>
</html>
