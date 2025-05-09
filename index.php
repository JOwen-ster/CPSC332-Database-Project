<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sched</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="landing_page.css">
</head>

<body>
    <div class="main-content">
        <!-- https://iconsvg.xyz/ -->
        <!-- add a toast notification when actions are done -->
        <!-- Left Panel - Branding -->
        <div class="left-panel">
            <?php
                require_once "db/connection.php"
            ?>
            <div class="brand-container">
                <div class="brand-header">
                    <div class="brand-logo">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </div>
                    <h1 class="brand-name">Sched</h1>
                </div>
                <p class="brand-tagline">
                    Schedule, plan, and manage events with elegance and simplicity.
                </p>
            </div>
        </div>

        <!-- Right Panel - Login Form -->
        <div class="right-panel">
    <?php
        if (!session_id()) session_start();
    ?>
    <div class="login-container">
        <div class="login-header">
            <h2 class="login-title">Glad to see you</h2>
            <p class="login-subtitle">
                Log in to gracefully handle all your events
            </p>
        </div>

        <form action="render/login.php" method="POST">
            <div class="form-group">
                <label class="form-label">
                    Username
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3"/><circle cx="12" cy="10" r="3"/><circle cx="12" cy="12" r="10"/></svg>
                </label>
                <div class="input-wrapper">
                    <input
                        name="i_username"
                        type="text"
                        placeholder="Your email address"
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
                        placeholder="Your password"
                        class="form-input"
                        required
                    >
                </div>
            </div>

            <?php
                if (isset($_SESSION['last_auth_attempt_status']) && $_SESSION['last_auth_attempt_status']) {
                    echo '<div style="color: red; margin-bottom: 10px;">' . htmlspecialchars($_SESSION['last_auth_attempt_status']) . '</div>';
                    $_SESSION['last_auth_attempt_status'] = null;
                }
            ?>

            <button type="submit" class="submit-button">
                <span>Log in</span>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>
        </form>

                <p class="signup-text">
                    Don't have an account?
                    <a href="./signup" class="signup-link">Create account</a>
                </p>
            </div>

            <footer class="footer">
                &copy; 2025 Sched. All rights reserved.
            </footer>
        </div>
    </div>
</body>
</html>