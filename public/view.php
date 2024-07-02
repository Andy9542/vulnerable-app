<?php
session_start();

// Проверка аутентификации пользователя (необязательно, но добавляет реализма)
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$file = isset($_GET['file']) ? $_GET['file'] : 'default';

?>

<html>
<head>
    <title>View File</title>
</head>
<body>
    <h1>File Viewer</h1>
    <nav>
        <ul>
            <li><a href="?file=welcome">Welcome</a></li>
            <li><a href="?file=about">About</a></li>
            <li><a href="?file=contact">Contact</a></li>
        </ul>
    </nav>
    <div>
        <?php
        // Уязвимый код, демонстрирующий LFI
        if (file_exists($file)) {
            include($file);
        } elseif (file_exists($file . '.php')) {
            include($file . '.php');
        } else {
            echo "File not found: " . htmlspecialchars($file);
        }
        ?>
    </div>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
