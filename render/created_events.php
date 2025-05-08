<?php
require_once "../db/connection.php";
if (!session_id()) session_start();

if (isset($_POST['form_username'])) {
    $submitted_username = $_POST['form_username'];

    // Prepare statement to safely query the user ID
    $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $submitted_username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $user_id_number = $row['id'];

            // Store user ID in session if not already stored
            if (!isset($_SESSION['user_id_number'])) {
                $_SESSION['user_id_number'] = $user_id_number;
            }

            // Get all events created by the user
            $stmt = mysqli_prepare($conn, "SELECT * FROM events WHERE creator_id = ?");
            mysqli_stmt_bind_param($stmt, "i", $user_id_number);
            mysqli_stmt_execute($stmt);
            $events = mysqli_stmt_get_result($stmt);

            if ($events && mysqli_num_rows($events) > 0) {
                while ($event = mysqli_fetch_assoc($events)) {
                    echo '<div class="event-card">';
                    echo "<h3>" . htmlspecialchars($event['title']) . "</h3>";
                    echo "<p>Hosted by: " . htmlspecialchars($event['creator_id']) . "</p>";
                    echo "<p>" . htmlspecialchars($event['description']) . "</p>";
                    echo "<p>Start: " . htmlspecialchars($event['start']) . "</p>";
                    echo "<p>End: " . htmlspecialchars($event['end']) . "</p>";
                    echo "<p>Location: " . htmlspecialchars($event['location']) . "</p>";
                    echo "<p>Event ID: " . htmlspecialchars($event['event_id']) . "</p>";
                    echo "</div>";
                }
            } else {
                echo "You have no events.";
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "Query preparation failed.";
    }
} else {
    echo "Username not provided.";
}
?>
