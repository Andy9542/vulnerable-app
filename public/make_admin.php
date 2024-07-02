<?php
session_start();
include_once '../config.php';
$db_connection = pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASS);

// Проверка, авторизован ли пользователь
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$message = '';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    
    // Уязвимый код для демонстрации SQL-инъекции
    $query = "UPDATE users SET role = 'admin' WHERE id = $user_id";
    
    if (pg_query($db_connection, $query)) {
        $message = "User with ID $user_id has been made an admin.";
    } else {
        $message = "Error updating user role.";
    }
}

// Получение списка пользователей
$users_query = "SELECT id, username, role FROM users WHERE role != 'admin'";
$users_result = pg_query($db_connection, $users_query);
$users = pg_fetch_all($users_result);
?>

<html>
<body>
    <h1>Make User Admin</h1>
    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    
    <h2>Users:</h2>
    <ul>
    <?php foreach ($users as $user): ?>
        <li>
            <?php echo htmlspecialchars($user['username']); ?> 
            (Current role: <?php echo htmlspecialchars($user['role']); ?>)
            <a href="?user_id=<?php echo $user['id']; ?>">Make Admin</a>
        </li>
    <?php endforeach; ?>
    </ul>
    
    <a href="admin/dashboard.php">Back to Dashboard</a>
</body>
</html>
