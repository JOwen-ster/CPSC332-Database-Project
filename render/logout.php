<?php
    // set all vars to empty and close session
    // redirect to landing page
    if (!session_id()) session_start();
    session_unset();
    session_destroy();
    header("Location: ../")
?>

