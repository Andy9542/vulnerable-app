<?php
// /var/www/vulnerable-app/includes/file_upload.php
function upload_image($file) {
    $target_dir = "/var/www/vulnerable-app/uploads/";
    $target_file = $target_dir . basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        return false;
    }
}
?>
