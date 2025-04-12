<?php
    session_start();
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    session_start();
    header("Location: ?page=home"); // Redirect to login page
exit();
?>