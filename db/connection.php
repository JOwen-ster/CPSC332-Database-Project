<?php
$db_server = "localhost";
$db_user = "auth";
$db_pass = "dbroot%q";
$db_name = "eventsystem";


try {
    $conn = mysqli_connect(
        $db_server,
        $db_user,
        $db_pass,
        $db_name
    );
} catch (mysqli_sql_exception) {
    echo "Failed to connect to database...";
}
?>
