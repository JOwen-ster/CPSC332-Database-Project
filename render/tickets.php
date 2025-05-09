<?php
require_once "../db/connection.php";
if (!session_id()) session_start();

if (!isset($_SESSION['user_id'])) {
    echo "User session not found.";
    exit();
}

$user_id = $_SESSION['user_id'];

// Modified query to also select ticket_id from tickets table
$sql = "
    SELECT events.*, tickets.ticket_id, users.username AS creator_username
    FROM tickets
    INNER JOIN events ON tickets.event_id = events.event_id
    INNER JOIN users ON events.creator_id = users.id
    WHERE tickets.user_id = ?
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    while ($event = mysqli_fetch_assoc($result)) {
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

        echo "<div class=\"event-id\">Ticket ID: " . htmlspecialchars($event['ticket_id']) . "</div>";
        echo "<div class=\"event-id\">Event ID: " . htmlspecialchars($event['event_id']) . "</div>";
        echo "</div>";
    }
} else {
    echo "<h3>You don't have any tickets yet.</h3>";
}
?>
