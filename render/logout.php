<?php
    // set all vars to empty and close session
    // redirect to landing page
    session_start();
    $_SESSION = [];
    session_destroy();
    header("Location: ../")
?>

