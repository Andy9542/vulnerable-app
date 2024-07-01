<?php
// /var/www/vulnerable-app/includes/admin.php
function get_all_users() {
    global $db_connection;
    $query = "SELECT * FROM users";
    $result = pg_query($db_connection, $query);
    return pg_fetch_all($result);
}

function delete_user($id) {
    global $db_connection;
    $query = "DELETE FROM users WHERE id = $id";
    return pg_query($db_connection, $query);
}
?>
