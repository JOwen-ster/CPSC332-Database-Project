<?php
include "../db/connection.php";
if (!session_id()) session_start();

$submitted_username = "development"; // Example username — replace with $_POST['username']

// Escape the input to prevent SQL injection
$submitted_username = mysqli_real_escape_string($conn, $submitted_username);

// Query user_id_number from the users table
$formatted_query = "SELECT user_id_number FROM users WHERE username = '$submitted_username'";
$result = mysqli_query($conn, $formatted_query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_id_number = $row['user_id_number'];

    // Store the user's ID in the session
    if (!isset($_SESSION['user_id_number'])) {
        $_SESSION['user_id_number'] = $user_id_number;
    }

    // Now get all events created by this user
    $sql = "SELECT * FROM events WHERE creator_id = $user_id_number";
    $fetched_user_events = mysqli_query($conn, $sql);

    // Loop through events and output them
    if ($fetched_user_events && mysqli_num_rows($fetched_user_events) > 0) {
        while ($event = mysqli_fetch_assoc($fetched_user_events)) {
            echo "<div>";
            echo "<h3>" . htmlspecialchars($event['title']) . "</h3>"; // . is used for concatination
            echo "<p>" . htmlspecialchars($event['description']) . "</p>";
            echo "<p>" . htmlspecialchars($event['datetime']) . "</p>";
            echo "<p>" . htmlspecialchars($event['location']) . "</p>";
            echo "<p>" . htmlspecialchars($event['creator']) . "</p>";
            echo "<p>" . htmlspecialchars($event['attendees']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "You have no events";
    }
} else {
    echo "User not found.";
}
?>
