<?php
session_start();
include_once '../config.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "/var/www/vulnerable-app/uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    // Vulnerable file upload - no checks on file type or content
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $message = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        $message = "Sorry, there was an error uploading your file.";
    }
}
?>

<html>
<head>
    <title>File Upload</title>
</head>
<body>
    <h2>Upload File</h2>
    <?php echo $message; ?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select file to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload File" name="submit">
    </form>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
