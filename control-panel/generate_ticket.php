<?php
require_once "../db/connection.php";
if (!session_id()) session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../control-panel?status=" . urlencode("User session not found."));
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['event_id']) && is_numeric($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    $sql_creator_check = "SELECT creator_id FROM events WHERE event_id = ?";
    $stmt_creator = mysqli_prepare($conn, $sql_creator_check);
    mysqli_stmt_bind_param($stmt_creator, "i", $event_id);
    mysqli_stmt_execute($stmt_creator);
    $result_creator = mysqli_stmt_get_result($stmt_creator);

    if ($row = mysqli_fetch_assoc($result_creator)) {
        if ($row['creator_id'] == $user_id) {
            header("Location: ../control-panel?status=" . urlencode("You cannot enroll in your own event."));
            exit();
        }
    } else {
        header("Location: ../control-panel?status=" . urlencode("Event not found."));
        exit();
    }

    $sql_check = "SELECT ticket_id FROM tickets WHERE user_id = ? AND event_id = ?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "ii", $user_id, $event_id);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        header("Location: ../control-panel?status=" . urlencode("You already have a ticket for this event."));
        exit();
    }

    $sql_insert = "INSERT INTO tickets (user_id, event_id) VALUES (?, ?)";
    $stmt_insert = mysqli_prepare($conn, $sql_insert);
    mysqli_stmt_bind_param($stmt_insert, "ii", $user_id, $event_id);

    if (mysqli_stmt_execute($stmt_insert)) {
        header("Location: ../control-panel?status=" . urlencode("Ticket created successfully."));
        exit();
    } else {
        header("Location: ../control-panel?status=" . urlencode("Failed to create ticket."));
        exit();
    }
} else {
    header("Location: ../control-panel?status=" . urlencode("Invalid event ID."));
    exit();
}
?>
