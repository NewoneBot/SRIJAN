<?php
include 'config.php';

// Check if the user is logged in
// if (!isset($_SESSION['user_id'])) {
//     exit("Unauthorized access");
// }

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $fh = $_POST['fh'];
    $fho = $_POST['fho'];
    $nation = $_POST['nation'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $gender = isset($_POST['gender']) ? ($_POST['gender'] === 'male' ? 'Male' : ($_POST['gender'] === 'female' ? 'Female' : 'Transgender')) : '';
    $language = isset($_POST['language']) ? $_POST['language'] : '';
    $course = isset($_POST['course']) ? $_POST['course'] : '';
    $mode = isset($_POST['mode']) ? $_POST['mode'] : '';
    $graduate = $_POST['graduate'];
    $post_graduate = $_POST['post_graduate'];

    $email = $_SESSION['email'];

    // Check if the record already exists
    $sql_check = "SELECT * FROM students WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows == 0) {
        // Record does not exist, insert into database
        $isChecked10th = isset($_POST['10th']) ? 'Yes' : 'NO';
        $isChecked12th = isset($_POST['12th']) ? 'Yes' : 'NO';

        // Prepare image data for insertion
        $photo_data = file_get_contents($_FILES['photo']['tmp_name']);
        $certificate_data = file_get_contents($_FILES['certificate']['tmp_name']);
        $adhar_data = file_get_contents($_FILES['adhar']['tmp_name']);
        $sign_data = file_get_contents($_FILES['sign']['tmp_name']);

        // Insert data into the database
        $sql_insert = "INSERT INTO students (user_id, fh, fho, nation, phone, city, state, pincode, gender, language, course, mode, 10th, 12th, graduate, post_graduate, photo, certificate, adhar, sign) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);

        if ($stmt_insert === false) {
            // Print detailed error information
            die("Error preparing statement: " . $conn->error);
        }

        $stmt_insert->bind_param("isssssssssssssssssss", $user_id, $fh, $fho, $nation, $phone, $city, $state, $pincode, $gender, $language, $course, $mode, $isChecked10th, $isChecked12th, $graduate, $post_graduate, $photo_data, $certificate_data, $adhar_data, $sign_data);

        if ($stmt_insert->execute()) {
            echo "<script>resetForm();</script>"; // Reset the form
            echo "<script>window.location.href = 'index.php';</script>"; // Redirect to index.php
            exit();
        } else {
            echo "Error executing statement: " . $stmt_insert->error;
        }
    } else {
        echo "Record already exists";
    }
}

$conn->close();
?>