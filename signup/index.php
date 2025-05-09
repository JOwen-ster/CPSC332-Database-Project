USE THIS FORM AS A BASELINE TO IMPLEMENT IN INTO THE HTML AND CSS BELLOW
<form method="POST" action="signup.php">
        <label for="i_username">Username:</label><br>
        <input type="text" name="i_username" id="i_username" required><br><br>

        <label for="i_password">Password:</label><br>
        <input type="password" name="i_password" id="i_password" required><br><br>

        <button type="submit">Sign Up</button>
</form>

# USE THIS STYLING AND LAYOUT

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