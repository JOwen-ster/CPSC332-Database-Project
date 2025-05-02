<?php
    if (!session_id()) session_start();

    require_once '../db/connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['i_username'] ?? '';
        $password = $_POST['i_password'] ?? '';

        // Prepare statement to prevent SQL injection
        $stmt = mysqli_prepare($conn, "SELECT id FROM user WHERE username = ? AND password = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $username, $password);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) === 1) {
                // User found, set session variables
                $_SESSION['authenticated'] = true;
                $_SESSION['form_username'] = $username;
                $_SESSION['last_auth_attempt_status'] = null;

                mysqli_stmt_close($stmt);
                header("Location: ../dashboard");
                exit();
            } else {
                // User not found or wrong credentials
                $_SESSION['last_auth_attempt_status'] = "Invalid username or password.";
                mysqli_stmt_close($stmt);
                header("Location: ../index.php");
                exit();
            }
        } else {
            echo "Database query failed.";
        }
    }
?>
