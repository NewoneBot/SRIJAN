<?php
session_start();

// sesion store 
$email = $_SESSION['email'];
$f_name = $_SESSION['f_name'];
$user_id = $_SESSION['user_id'];
// $payment = $_SESSION['payment'];

if(!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}


// Logout process
if (isset($_POST['logout'])) {
    // Destroy the session
    session_destroy();
    
    // Redirect to the login page or any other page after logout
    header("Location: ../index.php");
    exit();
}


 



?>