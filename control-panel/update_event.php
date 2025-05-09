<?php
require_once "../db/connection.php"; // Assumes $conn = mysqli_connect(...)

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["event_id"])) {
    $event_id = intval($_POST["event_id"]);
    $fields = ["title", "description", "start_datetime", "end_datetime", "location"];
    $set_clauses = [];
    $params = [];
    $types = "";

    foreach ($fields as $field) {
        if (!empty($_POST[$field])) {
            $value = $_POST[$field];

            // Convert datetime-local format to SQL datetime
            if (in_array($field, ["start_datetime", "end_datetime"])) {
                $dt = DateTime::createFromFormat('Y-m-d\TH:i', $value);
                if ($dt) {
                    $value = $dt->format('Y-m-d H:i:00');
                } else {
                    $message = "Invalid datetime format for $field.";
                    header("Location: ../control_panel?status=" . urlencode($message));
                    exit();
                }
            }

            $set_clauses[] = "$field = ?";
            $params[] = $value;
            $types .= "s";
        }
    }

    if (!empty($set_clauses)) {
        $sql = "UPDATE events SET " . implode(", ", $set_clauses) . " WHERE event_id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            $types .= "i";
            $params[] = $event_id;

            // Bind parameters dynamically
            $bind_names[] = $stmt;
            $bind_names[] = $types;
            foreach ($params as $key => $value) {
                $bind_names[] = &$params[$key];
            }

            call_user_func_array('mysqli_stmt_bind_param', $bind_names);

            if (mysqli_stmt_execute($stmt)) {
                $message = "Event updated successfully!";
            } else {
                $message = "Error updating event: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            $message = "Error preparing SQL: " . mysqli_error($conn);
        }
    } else {
        $message = "No fields provided to update.";
    }
} else {
    $message = "Event ID is required.";
}

mysqli_close($conn);

// Redirect back to the form with a message
header("Location: ../control-panel?status=" . urlencode($message));
exit();
?>
