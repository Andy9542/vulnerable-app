<?php
include_once '../config.php';
$db_connection = pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASS);

$results = [];
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT * FROM posts WHERE title LIKE '%" . $search . "%'";
    $result = pg_query($db_connection, $query);
    $results = pg_fetch_all($result);
}
?>
<html>
<body>
    <h2>Search Posts</h2>
    <form method="GET" action="search.php">
        <input type="text" name="search" placeholder="Enter search term">
        <input type="submit" value="Search">
    </form>
    <?php
    if ($results) {
        foreach ($results as $post) {
            echo "<h3>{$post['title']}</h3>";
            echo "<p>{$post['content']}</p>";
        }
    } elseif (isset($_GET['search'])) {
        echo "No results found.";
    }
    ?>
</body>
</html>
