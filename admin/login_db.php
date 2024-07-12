<?php
session_start();

if(isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

include 'config.php';

$email_error = "";
$password_error = "";

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch data from the register table
    $sql = "SELECT * FROM register WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, fetch user data
        $row = $result->fetch_assoc();
        
        if ($row['password'] === $password) {
            // Password is correct, store user data in session variables
            $_SESSION['user_id'] = $row['id']; 
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['payment'] = $row['payment'];


            // Redirect to home page or any other appropriate page
            header("Location: index.php");
            exit();
        } else {
            // Password is incorrect
            $password_error = "Incorrect password.";
        }
    } else {
        // User does not exist (email is incorrect)
        $email_error = "Incorrect email";
    }
}

$conn->close();
?>