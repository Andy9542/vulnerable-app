<?php
// /var/www/vulnerable-app/public/uploaded_files.php
$upload_dir = "/var/www/vulnerable-app/uploads/";
$files = scandir($upload_dir);

echo "<h2>Uploaded Files</h2>";
echo "<ul>";
foreach ($files as $file) {
    if ($file != "." && $file != "..") {
        echo "<li><a href='/uploads/$file'>$file</a></li>";
    }
}
echo "</ul>";
?>
