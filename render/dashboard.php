<?php
    include "../db/connection.php";

    // store the users id under SESSION
    if(!session_id()) session_start();
    $user_id_number = 1;
    if(!isset($_SESSION['filename'])) { //check if id number was assigned
        $_SESSION['user_id_number'] = $user_id_number;
    }

    $sql = "SELECT * FROM events WHERE creator_id = $user_id_number";
?>