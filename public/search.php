<?php
// /var/www/vulnerable-app/public/search.php
include_once '../includes/posts.php';

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT * FROM posts WHERE title LIKE '%" . $search . "%'";
    $result = pg_query($db_connection, $query);
    $posts = pg_fetch_all($result);

    if ($posts) {
        foreach ($posts as $post) {
            echo "<h3><a href='posts.php?id={$post['id']}'>{$post['title']}</a></h3>";
            echo "<p>" . substr($post['content'], 0, 100) . "...</p>";
        }
    } else {
        echo "No results found";
    }
}
?>
