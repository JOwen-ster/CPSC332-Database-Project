<?php
    if (!session_id()) session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up</title>
        <link rel="stylesheet" href="../landing_page.css">
</head>
<body>
<div class="login-container">
    <div class="login-header">
        <h2 class="login-title">Join us</h2>
        <p class="login-subtitle">
            Sign up to gracefully handle all your events
        </p>
    </div>

    <form action="signup.php" method="POST">
        <div class="form-group">
            <label class="form-label">
                Username
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3"/><circle cx="12" cy="10" r="3"/><circle cx="12" cy="12" r="10"/></svg>
            </label>
            <div class="input-wrapper">
                <input
                    name="i_username"
                    type="text"
                    placeholder="Choose a username"
                    class="form-input"
                    required
                >
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">
                Password
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            </label>
            <div class="input-wrapper">
                <input
                    name="i_password"
                    type="password"
                    placeholder="Create a password"
                    class="form-input"
                    required
                >
            </div>
        </div>

        <?php
            if (isset($_SESSION['signup_status']) && $_SESSION['signup_status']) {
                echo '<div style="color: red; margin-bottom: 10px;">' . htmlspecialchars($_SESSION['signup_status']) . '</div>';
                $_SESSION['signup_status'] = null;
            }
        ?>

        <button type="submit" class="submit-button">
            <span>Sign Up</span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </button>
    </form>

    <p class="signup-text">
        Already have an account?
        <a href="../" class="signup-link">Log in</a>
    </p>

    <footer class="footer">
        &copy; 2025 Sched. All rights reserved.
    </footer>
</div>
</body>
</html>
