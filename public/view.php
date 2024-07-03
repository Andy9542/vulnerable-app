<?php
session_start();
include_once '../config.php';

// Проверка аутентификации пользователя (необязательно, но добавляет реализма)
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$file = isset($_GET['file']) ? $_GET['file'] : 'default';

// Модифицированная функция для отображения и выполнения содержимого файла
function safe_display_file($filepath) {
    if (stripos($filepath, 'php://') === 0) {
        // Если используется PHP-обертка, просто включаем файл
        include($filepath);
    } else {
        // Для обычных файлов используем include вместо file_get_contents
        include($filepath);
    }
}

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
        // Упрощенная логика для включения файлов
        if (file_exists($file) || file_exists($file . '.php')) {
            echo "<h2>Displaying file: " . htmlspecialchars($file) . "</h2>";
            safe_display_file($file);
        } else {
            echo "<h2>File not found</h2>";
            echo "Requested file: " . htmlspecialchars($file) . "<br>";
            echo "Current working directory: " . getcwd() . "<br>";
            echo "include_path: " . get_include_path() . "<br>";
        }
        ?>
    </div>
    <p><a href="index.php">Back to Home</a></p>
    <div>
        <h3>Debug Information:</h3>
        <p>PHP Version: <?php echo phpversion(); ?></p>
        <p>allow_url_fopen: <?php echo ini_get('allow_url_fopen') ? 'On' : 'Off'; ?></p>
        <p>allow_url_include: <?php echo ini_get('allow_url_include') ? 'On' : 'Off'; ?></p>
        <p>open_basedir: <?php echo ini_get('open_basedir') ?: 'Not set'; ?></p>
        <p>disable_functions: <?php echo ini_get('disable_functions') ?: 'Not set'; ?></p>
    </div>
</body>
</html>
