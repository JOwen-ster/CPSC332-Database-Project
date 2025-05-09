<?php
require_once "../db/connection.php";
if (!session_id()) session_start();

// Redirect helper
function redirect_with_status($message) {
    header("Location: ../control-panel?status=" . urlencode($message));
    exit();
}

if (!isset($_SESSION['user_id'])) {
    redirect_with_status("User session not found.");
}

$user_id = $_SESSION['user_id'];

if (!isset($_POST['event_id']) || !is_numeric($_POST['event_id'])) {
    redirect_with_status("Invalid event ID.");
}

$event_id = $_POST['event_id'];

// Check if the current user is the creator of the event
$sql = "SELECT creator_id FROM events WHERE event_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $event_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $event = mysqli_fetch_assoc($result);
    if ($event['creator_id'] != $user_id) {
        redirect_with_status("You don't have permission to delete this event.");
    }

    // User is authorized, proceed to delete the event
    $delete_sql = "DELETE FROM events WHERE event_id = ?";
    $delete_stmt = mysqli_prepare($conn, $delete_sql);
    mysqli_stmt_bind_param($delete_stmt, "i", $event_id);

    if (mysqli_stmt_execute($delete_stmt)) {
        redirect_with_status("Event deleted successfully.");
    } else {
        redirect_with_status("Failed to delete the event.");
    }
} else {
    redirect_with_status("Event not found.");
}
?>
