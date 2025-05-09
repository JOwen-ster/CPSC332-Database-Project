<?php
session_start();
require_once "../db/connection.php"; // Assumes $conn = mysqli_connect(...)

$message = "";

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    $message = "You must be logged in to create an event.";
    header("Location: ../control-panel?status=" . urlencode($message));
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fields = ["title", "description", "start_datetime", "end_datetime", "location"];
    $placeholders = [];
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
                    header("Location: ../control-panel?status=" . urlencode($message));
                    exit();
                }
            }

            $placeholders[] = $field;
            $params[] = $value;
            $types .= "s";
        }
    }

    // Add creator_id from session
    $placeholders[] = "creator_id";
    $params[] = $_SESSION['user_id'];
    $types .= "i";

    // Build SQL
    $columns = implode(", ", $placeholders);
    $placeholders_sql = implode(", ", array_fill(0, count($placeholders), "?"));

    $sql = "INSERT INTO events ($columns) VALUES ($placeholders_sql)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        $bind_names[] = $stmt;
        $bind_names[] = $types;

        foreach ($params as $key => $value) {
            $bind_names[] = &$params[$key]; // References needed
        }

        call_user_func_array('mysqli_stmt_bind_param', $bind_names);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Event created successfully!";
        } else {
            $message = "Error creating event: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        $message = "Error preparing SQL: " . mysqli_error($conn);
    }
} else {
    $message = "Invalid request.";
}

mysqli_close($conn);

// Redirect back to the form with a message
header("Location: ../control-panel?status=" . urlencode($message));
exit();
?>
