<?php
include_once '../config.php';
$db_connection = pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASS);

// Функция для получения всех постов
function get_all_posts() {
    global $db_connection;
    $query = "SELECT * FROM posts ORDER BY created_at DESC";
    $result = pg_query($db_connection, $query);
    return pg_fetch_all($result);
}

// Функция для получения конкретного поста
function get_post($id) {
    global $db_connection;
    $query = "SELECT * FROM posts WHERE id = $id";
    $result = pg_query($db_connection, $query);
    return pg_fetch_assoc($result);
}

// Обработка создания нового поста
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 1; // Используем ID 1, если пользователь не авторизован
    
    $query = "INSERT INTO posts (title, content, author_id) VALUES ('$title', '$content', $author_id)";
    pg_query($db_connection, $query);
    
    header("Location: posts.php");
    exit();
}

// Получение постов
if (isset($_GET['id'])) {
    $post = get_post($_GET['id']);
} else {
    $posts = get_all_posts();
}
?>

<html>
<body>
    <h1>Posts</h1>
    
    <?php if (isset($post)): ?>
        <h2><?php echo htmlspecialchars($post['title']); ?></h2>
        <p><?php echo htmlspecialchars($post['content']); ?></p>
        <a href="posts.php">Back to all posts</a>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <h2><a href="?id=<?php echo $post['id']; ?>"><?php echo htmlspecialchars($post['title']); ?></a></h2>
            <p><?php echo substr(htmlspecialchars($post['content']), 0, 100); ?>...</p>
        <?php endforeach; ?>
        
        <h2>Create new post</h2>
        <form method="POST">
            <input type="text" name="title" placeholder="Title" required><br>
            <textarea name="content" placeholder="Content" required></textarea><br>
            <input type="submit" value="Create Post">
        </form>
    <?php endif; ?>
</body>
</html>
