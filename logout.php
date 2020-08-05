<?php
    session_start();

    //clear session
    if (isset($_SESSION['email'])) {
        session_destroy();
        unset($_SESSION['email']);
    }

    if (isset($_SESSION['emailadmin'])) {
        session_destroy();
        unset($_SESSION['emailadmin']);
    }

    //back to index.php
    header("Location: index.php");
    
?>