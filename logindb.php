<?php
session_start(); 

include_once "include/config1.php";

if(isset($_POST['email']) && isset($_POST['password'])) {
    // Fetch form data
    $email = $_POST['email'];
    $password = $_POST['password']; 

    $sql = "SELECT id, f_name, email, Password, login_type, payment FROM users WHERE email = :email";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':email', $email); 
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($user) {        
        if ($user['Password'] === $password) { 

            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['f_name'] = $user['f_name']; 
            $_SESSION['login_type'] = $user['login_type']; 
            $_SESSION['payment'] = $user['payment']; 

            $sessionData = array(
                'email' => $user['email'],
                'id' => $user['id'],
                'login_type' => $user['login_type'],
                'payment' => $user['payment']
            );

            $encodedSessionData = json_encode($sessionData);

            $response = array(
                'success' => true,
                'message' => 'Login successful',
                'sessionData' => $encodedSessionData
            );
        } else {
            
            $response = array(
                'success' => false,
                'message' => 'Incorrect password'
            );
        }
    } else {
        // Email not found
        $response = array(
            'success' => false,
            'message' => 'User Not Found'
        );
    }

    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit(); // Stop further execution
} else {
    // Form fields not provided
    $response = array(
        'success' => false,
        'message' => 'Email and password are required'
    );

    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit(); // Stop further execution
}
?>