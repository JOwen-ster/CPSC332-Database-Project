<?php
    if (!session_id()) session_start();

    require_once '../db/connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['i_username'] ?? '';
        $password = $_POST['i_password'] ?? '';

        if (empty($username) || empty($password)) {
            $_SESSION['signup_status'] = "Username and password are required.";
            header("Location: ../signup");
            exit();
        }

        // Check if username already exists
        $checkStmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ?");
        if ($checkStmt) {
            mysqli_stmt_bind_param($checkStmt, "s", $username);
            mysqli_stmt_execute($checkStmt);
            mysqli_stmt_store_result($checkStmt);

            if (mysqli_stmt_num_rows($checkStmt) > 0) {
                $_SESSION['signup_status'] = "Username is already taken.";
                mysqli_stmt_close($checkStmt);
                header("Location: ../signup");
                exit();
            }
            mysqli_stmt_close($checkStmt);
        }

        // Insert new user
        $insertStmt = mysqli_prepare($conn, "INSERT INTO users (username, password) VALUES (?, ?)");
        if ($insertStmt) {
            mysqli_stmt_bind_param($insertStmt, "ss", $username, $password);
            if (mysqli_stmt_execute($insertStmt)) {
                $_SESSION['signup_status'] = "Signup successful. You can now log in.";
                header("Location: ../");
                exit();
            } else {
                $_SESSION['signup_status'] = "Signup failed. Please try again.";
                header("Location: ../signup");
                exit();
            }
            mysqli_stmt_close($insertStmt);
        } else {
            echo "Database query failed.";
        }
    }
?>
