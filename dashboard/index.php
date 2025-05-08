<?php 
    if (!session_id()) session_start();

    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
        echo 'Hello ' . htmlspecialchars($_SESSION['form_username']);
    } else {
        header('Location: ../');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <div style="display: flex; flex-direction: column;">
    <?php
        if (isset($_GET['id'])) {
            // Only render single event view
            include "../render/single_event.php"; // will url to render that data
        } else {
            echo 'hello :3';
            // Render all created events
            include "../render/created_events.php"; // where creator_id = user id
            // Enrolled events (tickets... each ticket has a foriegn key to the event)
            include "../render/tickets.php"; // SELECT EVENT where user id in JSON
        }
        ?>
    </div>
</body>
</html>