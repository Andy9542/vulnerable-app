<?php
// /var/www/vulnerable-app/public/posts.php
include_once '../includes/posts.php';

if (isset($_GET['id'])) {
    $post = get_post($_GET['id']);
    if ($post) {
        echo "<h2>{$post['title']}</h2>";
        echo "<p>{$post['content']}</p>";
    } else {
        echo "Post not found";
    }
} else {
    $posts = get_all_posts();
    foreach ($posts as $post) {
        echo "<h3><a href='?id={$post['id']}'>{$post['title']}</a></h3>";
        echo "<p>" . substr($post['content'], 0, 100) . "...</p>";
    }
}
?>
