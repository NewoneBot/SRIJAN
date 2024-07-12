<?php
include 'config.php';
include 'session_store.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$payment_id = $_POST['payment_id'];
$course_id = $_POST['course_id'];
$amount = $_POST['amount'];
$payment_type = $_POST['payment_type'];
$user_id = $_SESSION['user_id'];
$currentDateTime = date('Y-m-d H:i:s');


$updateUserQuery = "UPDATE users SET course_id=?, payment='1' WHERE id=?";
$updateUserStmt = $dbh->prepare($updateUserQuery);
$updateUserStmt->execute([$course_id, $user_id]);

$insertTransactionQuery = "INSERT INTO transactions (user_id, course_id, payment_method, amount, payment_id, transaction_date) 
                            VALUES (?, ?, ?, ?, ?, ?)";
$insertTransactionStmt = $dbh->prepare($insertTransactionQuery);
$insertTransactionStmt->execute([$user_id, $course_id, $payment_type, $amount, $payment_id, $currentDateTime]);

if ($updateUserStmt && $insertTransactionStmt) {
    echo "User information updated and transaction data inserted successfully.";
} else {
    echo "Error: Unable to process payment.";
}

$dbh = null;
?>