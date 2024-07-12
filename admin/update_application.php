<?php
session_start();

// Include database configuration
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id']) && isset($_POST['update'])) {
    // Retrieve form data
    $user_id = $_POST['user_id'];
    $fh = $_POST['fh'];
    $fho = $_POST['fho'];
    $nation = $_POST['nation'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $gender = isset($_POST['gender']) ? ($_POST['gender'] === 'male' ? 'Male' : 'Female') : '';
    $language = isset($_POST['language']) ? $_POST['language'] : '';
    $course = isset($_POST['course']) ? $_POST['course'] : '';
    $mode = isset($_POST['mode']) ? $_POST['mode'] : '';
    $graduate = $_POST['graduate'];
    $post_graduate = $_POST['post_graduate'];

    $isChecked10th = isset($_POST['is10th']) ? 'Yes' : 'NO';
    $isChecked12th = isset($_POST['is12th']) ? 'Yes' : 'NO';

    // Initialize an empty array to store the columns to update
    $columnsToUpdate = [];

    // Check each field to see if it's different from the original value
    if ($fh != $row_data['fh']) $columnsToUpdate[] = "fh = ?";
    if ($fho != $row_data['fho']) $columnsToUpdate[] = "fho = ?";
    if ($nation != $row_data['nation']) $columnsToUpdate[] = "nation = ?";
    if ($phone != $row_data['phone']) $columnsToUpdate[] = "phone = ?";
    if ($city != $row_data['city']) $columnsToUpdate[] = "city = ?";
    if ($state != $row_data['state']) $columnsToUpdate[] = "state = ?";
    if ($pincode != $row_data['pincode']) $columnsToUpdate[] = "pincode = ?";
    if ($isChecked10th != $row_data['is10th']) $columnsToUpdate[] = "is10th = ?";
    if ($isChecked12th != $row_data['is12th']) $columnsToUpdate[] = "is12th = ?";
    if ($gender != $row_data['gender']) $columnsToUpdate[] = "gender = ?";
    if ($language != $row_data['language']) $columnsToUpdate[] = "language = ?";
    if ($course != $row_data['course']) $columnsToUpdate[] = "course = ?";
    if ($mode != $row_data['mode']) $columnsToUpdate[] = "mode = ?";
    if ($graduate != $row_data['graduate']) $columnsToUpdate[] = "graduate = ?";
    if ($post_graduate != $row_data['post_graduate']) $columnsToUpdate[] = "post_graduate = ?";

    // Prepare the SQL update statement
    $sql_update = "UPDATE students SET ";
    $sql_update .= implode(", ", $columnsToUpdate);
    $sql_update .= " WHERE user_id = ?";
    
    // Bind parameters
    $bindParams = str_repeat("s", count($columnsToUpdate));
    $bindParams .= "s";
    $bindValues = array_values(array_filter([$fh, $fho, $nation, $phone, $city, $state, $pincode, $isChecked10th, $isChecked12th, $gender, $language, $course, $mode, $graduate, $post_graduate, $user_id]));

    // Prepare image data for insertion
    $photo_tmp = $_FILES['photo']['tmp_name'];
    $certificate_tmp = $_FILES['certificate']['tmp_name'];
    $adhar_tmp = $_FILES['adhar']['tmp_name'];
    $sign_tmp = $_FILES['sign']['tmp_name'];

    if (!empty($photo_tmp)) {
        $photo_data = file_get_contents($photo_tmp);
        $sql_update .= ", photo = ?";
        $bindParams .= "s";
        $bindValues[] = $photo_data;
    }

    if (!empty($certificate_tmp)) {
        $certificate_data = file_get_contents($certificate_tmp);
        $sql_update .= ", certificate = ?";
        $bindParams .= "s";
        $bindValues[] = $certificate_data;
    }

    if (!empty($adhar_tmp)) {
        $adhar_data = file_get_contents($adhar_tmp);
        $sql_update .= ", adhar = ?";
        $bindParams .= "s";
        $bindValues[] = $adhar_data;
    }

    if (!empty($sign_tmp)) {
        $sign_data = file_get_contents($sign_tmp);
        $sql_update .= ", sign = ?";
        $bindParams .= "s";
        $bindValues[] = $sign_data;
    }

    // Prepare and bind parameters
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param($bindParams, ...$bindValues);

    if ($stmt_update->execute()) {
        echo "Application updated successfully";
    } else {
        echo "Error updating application: " . $stmt_update->error;
    }

    // Redirect to another page
    header("Location: application_report.php");
    exit();
}

$conn->close();
?>