<?php
require_once "../db/connection.php";
if (!session_id()) session_start();

if (isset($_SESSION['user_id'])) {
    $user_id_number = $_SESSION['user_id'];

    $stmt = mysqli_prepare($conn, "
        SELECT events.*, users.username AS creator_username
        FROM events
        JOIN users ON events.creator_id = users.id
        WHERE events.creator_id = ?
    ");
    mysqli_stmt_bind_param($stmt, "i", $user_id_number);
    mysqli_stmt_execute($stmt);
    $events = mysqli_stmt_get_result($stmt);

    if ($events && mysqli_num_rows($events) > 0) {
        while ($event = mysqli_fetch_assoc($events)) {
            echo '<div class="event-card">';
            echo "<h3>" . htmlspecialchars($event['title']) . "</h3>";
            echo "<p class=\"host\">Hosted by: " . htmlspecialchars($event['creator_username']) . "</p>";
            echo "<p class=\"description\">" . htmlspecialchars($event['description']) . "</p>";

            echo "<div class=\"time-container\">";
            echo "<div class=\"time-label\">Start:</div>";
            echo "<div class=\"time-value\">" . htmlspecialchars($event['start_datetime']) . "</div>";
            echo "</div>";

            echo "<div class=\"time-container\">";
            echo "<div class=\"time-label\">End:</div>";
            echo "<div class=\"time-value\">" . htmlspecialchars($event['end_datetime']) . "</div>";
            echo "</div>";

            echo "<div class=\"location\">";
            echo "<div class=\"location-dot\"></div>";
            echo "<div class=\"location-value\">" . htmlspecialchars($event['location']) . "</div>";
            echo "</div>";

            echo "<div class=\"event-id\">Event ID: " . htmlspecialchars($event['event_id']) . "</div>";
            echo "</div>";
        }
    } else {
        echo "<h3>You have no events.</h3>";
    }
} else {
    echo "User session not found.";
}
?>
