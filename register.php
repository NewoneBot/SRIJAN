<?php 
session_start();
$email = $_GET['email'];
$f_name = $_GET['f_name'];
$password = $_GET['password'];

// echo $email.$f_name.$password;

include 'include/config1.php';



// Prepare the SQL statement
$sql = "INSERT INTO users (f_name, email, password) VALUES (?, ?, ?)";

// Prepare the statement
$stmt = $dbh->prepare($sql);

// Bind parameters
$stmt->bindParam(1, $f_name);
$stmt->bindParam(2, $email);
$stmt->bindParam(3, $password);

// Execute the query
if ($stmt->execute()) {
    $lastInsertedId = $dbh->lastInsertId();

    $_SESSION['f_name'] = $f_name;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['user_id'] = $lastInsertedId;
    header("Location: admin/registration.php");
    exit;
} else {
    echo "Error inserting record: " . $stmt->errorInfo();
}





?>