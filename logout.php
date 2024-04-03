<?php
if(isset($_GET['logout'])) {
    // Unset and destroy the session to log out
    session_start();
    session_unset();
    session_destroy();
   
}

header('Location: index.php');  
?>