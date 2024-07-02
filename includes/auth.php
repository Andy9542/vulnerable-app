function register($username, $password, $email) {
    global $db_connection;
    $hashed_password = md5($password); // Использование MD5 вместо более безопасных методов
    $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
    return pg_query($db_connection, $query);
}
