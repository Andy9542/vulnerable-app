<?php
// /var/www/vulnerable-app/seed_data.php
include_once 'config.php';

$db_connection = pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASS);

// Добавление тестовых пользователей
$users = [
    ['admin', 'admin123', 'admin@example.com', 'admin'],
    ['user1', 'password1', 'user1@example.com', 'user'],
    ['user2', 'password2', 'user2@example.com', 'user']
];

foreach ($users as $user) {
    $query = "INSERT INTO users (username, password, email, role) VALUES ('$user[0]', MD5('$user[1]'), '$user[2]', '$user[3]')";
    pg_query($db_connection, $query);
}

// Добавление тестовых записей
$posts = [
    ['First Post', 'This is the content of the first post.', 1],
    ['Second Post', 'This is the content of the second post.', 2],
    ['Third Post', 'This is the content of the third post.', 3]
];

foreach ($posts as $post) {
    $query = "INSERT INTO posts (title, content, author_id) VALUES ('$post[0]', '$post[1]', $post[2])";
    pg_query($db_connection, $query);
}

echo "Seed data added successfully!";
?>
