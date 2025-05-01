<?php
    include "../db/connection.php";
    if(!session_id()) session_start();


    $submitted_username = "dev"; //get username from login form
    $formatted_query = "SELECT user_id_number FROM events WHERE username = $submitted_username";
    $user_id_number = mysqli_query($conn, $formatted_query);

    //store the users id under SESSION globally
    if(!isset($_SESSION['user_id_number'])) { //check if id number was assigned
        $_SESSION['user_id_number'] = $user_id_number;
    }

    $sql = "SELECT * FROM events WHERE creator_id = $user_id_number";
?>