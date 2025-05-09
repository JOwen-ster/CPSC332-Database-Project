<?php 
    if (!session_id()) session_start();

    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
        $username = htmlspecialchars($_SESSION['form_username']);
    } else {
        header('Location: ../');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1 class="welcome-text">Welcome, <?php echo $username;?></h1>
            <button class="purple-button">
                <a class="button-a" href="../control-panel">
                    Control Panel
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                </a>
            </button>
            <form action="../render/logout.php" method="post">
                <button class="purple-button" type="submit">
                Logout
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 3H6a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h4M16 17l5-5-5-5M19.8 12H9"/></svg>
            </button>
            </form>
        </header>

        <?php if (isset($_GET['id'])): ?>
            <!-- Single Event View -->
            <div class="single-event">
                <?php include "../render/single_event.php"; ?>
            </div>
        <?php else: ?>
            <div class="events-grid">
                <!-- Created Events Section -->
                <div class="event-section">
                    <h2 class="section-title">Your Created Events</h2>
                    <?php include "../render/created_events.php"; ?>
                </div>

                <!-- Enrolled Events Section -->
                <div class="event-section">
                    <h2 class="section-title">Your Tickets</h2>
                    <?php include "../render/tickets.php"; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>