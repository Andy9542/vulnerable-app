<?php
// /var/www/vulnerable-app/includes/posts.php
function create_post($title, $content, $author_id) {
    global $db_connection;
    // Удалите или закомментируйте следующие строки для отключение валидации ввода
    // $title = pg_escape_string($title);
    // $content = pg_escape_string($content); 
   $query = "INSERT INTO posts (title, content, author_id) VALUES ('$title', '$content', $author_id)";
    return pg_query($db_connection, $query);
}

function update_post($id, $title, $content) {
    global $db_connection;
    $query = "UPDATE posts SET title = '$title', content = '$content' WHERE id = $id";
    return pg_query($db_connection, $query);
}

function delete_post($id) {
    global $db_connection;
    $query = "DELETE FROM posts WHERE id = $id";
    return pg_query($db_connection, $query);
}

function get_post($id) {
    global $db_connection;
    $query = "SELECT * FROM posts WHERE id = $id";
    $result = pg_query($db_connection, $query);
    return pg_fetch_assoc($result);
}

function get_all_posts() {
    global $db_connection;
    $query = "SELECT * FROM posts ORDER BY created_at DESC";
    $result = pg_query($db_connection, $query);
    return pg_fetch_all($result);
}
?>
