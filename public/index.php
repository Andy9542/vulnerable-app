<?php
// /var/www/vulnerable-app/public/index.php
?>
<html>
<body>
    <h2>Search Posts</h2>
    <form action="search.php" method="GET">
        <input type="text" name="search" placeholder="Enter search term">
        <input type="submit" value="Search">
    </form>
</body>
</html>
