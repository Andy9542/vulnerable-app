<?php
// /var/www/vulnerable-app/admin/view_logs.php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /login.php');
    exit;
}

$log_file = isset($_GET['file']) ? $_GET['file'] : 'app.log';
$log_path = "/var/log/" . $log_file;
$contents = file_get_contents($log_path);

echo "<h2>System Log: $log_file</h2>";
echo "<pre>$contents</pre>";
?>
