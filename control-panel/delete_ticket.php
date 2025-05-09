<?php
require_once "../db/connection.php";
if (!session_id()) session_start();

if (!isset($_SESSION['user_id'])) {
    $message = "User session not found.";
    header("Location: ../control-panel?status=" . urlencode($message));
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

// Check if ticket_id is provided via POST request and is a valid number
if (isset($_POST['ticket_id']) && is_numeric($_POST['ticket_id'])) {
    $ticket_id = $_POST['ticket_id'];

    // Prepare SQL to get event_id for the given ticket_id
    $sql_check_ticket = "SELECT ticket_id, user_id, event_id FROM tickets WHERE ticket_id = ?";
    $stmt_check_ticket = mysqli_prepare($conn, $sql_check_ticket);
    mysqli_stmt_bind_param($stmt_check_ticket, "i", $ticket_id);
    mysqli_stmt_execute($stmt_check_ticket);
    $result_check_ticket = mysqli_stmt_get_result($stmt_check_ticket);

    if (mysqli_num_rows($result_check_ticket) > 0) {
        $ticket = mysqli_fetch_assoc($result_check_ticket);
        $event_id = $ticket['event_id'];

        // Fetch the creator_id of the event using event_id
        $sql_check_event = "SELECT creator_id FROM events WHERE event_id = ?";
        $stmt_check_event = mysqli_prepare($conn, $sql_check_event);
        mysqli_stmt_bind_param($stmt_check_event, "i", $event_id);
        mysqli_stmt_execute($stmt_check_event);
        $result_check_event = mysqli_stmt_get_result($stmt_check_event);

        if (mysqli_num_rows($result_check_event) > 0) {
            $event = mysqli_fetch_assoc($result_check_event);
            $creator_id = $event['creator_id'];

            // Check if the current user is either the ticket holder or the event creator
            if ($ticket['user_id'] == $user_id || $creator_id == $user_id) {
                // Prepare SQL to delete the ticket
                $sql_delete = "DELETE FROM tickets WHERE ticket_id = ?";
                $stmt_delete = mysqli_prepare($conn, $sql_delete);
                mysqli_stmt_bind_param($stmt_delete, "i", $ticket_id);

                if (mysqli_stmt_execute($stmt_delete)) {
                    $message = "Ticket deleted successfully.";
                } else {
                    $message = "Failed to delete ticket.";
                }
            } else {
                $message = "You don't have permission to delete this ticket.";
            }
        } else {
            $message = "Event not found.";
        }
    } else {
        $message = "Ticket not found.";
    }
} else {
    $message = "Invalid ticket ID.";
}

// Redirect to control panel with message
header("Location: ../control-panel?status=" . urlencode($message));
exit();
?>
