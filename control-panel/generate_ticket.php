<?php
require_once "../db/connection.php";
if (!session_id()) session_start();

if (!isset($_SESSION['user_id'])) {
    echo "User session not found.";
    exit();
}

$message = "";

$user_id = $_SESSION['user_id'];

// Validate that event_id is provided and numeric
if (isset($_POST['event_id']) && is_numeric($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    // Optional: check if the user already has a ticket for this event
    $sql_check = "SELECT ticket_id FROM tickets WHERE user_id = ? AND event_id = ?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "ii", $user_id, $event_id);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "You already have a ticket for this event.";
        exit();
    }

    // Insert new ticket
    $sql_insert = "INSERT INTO tickets (user_id, event_id) VALUES (?, ?)";
    $stmt_insert = mysqli_prepare($conn, $sql_insert);
    mysqli_stmt_bind_param($stmt_insert, "ii", $user_id, $event_id);

    if (mysqli_stmt_execute($stmt_insert)) {
        header("Location: ../control-panel?status=" . urlencode($message));
        exit();
    } else {
        echo "Failed to create ticket.";
    }
} else {
    echo "Invalid event ID.";
}
?>
