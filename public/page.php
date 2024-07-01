<?php
// /var/www/vulnerable-app/public/page.php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
include($page . ".php");
?>
