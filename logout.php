<?php 
session_start();
// Destroy session
if(session_destroy()){
    // Redirect to login page.
    header("Location: login.php");
}
?>