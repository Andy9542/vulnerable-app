<?php
// /var/www/vulnerable-app/public/profile.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include_once '../includes/auth.php';
$user = get_user_by_id($_SESSION['user_id']);
?>
<html>
<body>
    <h2>User Profile</h2>
    <p>Username: <?php echo $user['username']; ?></p>
    <p>Email: <?php echo $user['email']; ?></p>
    <p>Role: <?php echo $user['role']; ?></p>
</body>
</html>
