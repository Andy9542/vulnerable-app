<?php
// /var/www/vulnerable-app/public/make_admin.php
session_start();
include_once '../includes/auth.php';

if (isset($_GET['make_admin']) && $_GET['make_admin'] == 1) {
    $query = "UPDATE users SET role = 'admin' WHERE id = " . $_SESSION['user_id'];
    pg_query($db_connection, $query);
    header('Location: profile.php');
    exit;
}
?>
