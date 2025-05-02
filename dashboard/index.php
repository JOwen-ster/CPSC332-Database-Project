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
    <div style="display: flex;">
        <!-- <?php include "../render/created_events.php"; ?> -->
    </div>
</body>
</html>