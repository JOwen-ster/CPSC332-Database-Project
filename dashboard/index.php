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
    <link rel="stylesheet" href="../render/style.css">
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1 class="welcome-text">Welcome back, <?php echo $username; ?></h1>
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
                    <h2 class="section-title">Your Enrolled Events</h2>
                    <?php include "../render/tickets.php"; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>