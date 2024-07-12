<?php
include 'config.php'; 

if(isset($_GET['assignBatch']) && $_GET['assignBatch'] === '1'){
$batchId = $_POST['batch_id'];
$checkedIdsString = $_POST['checkedIdsString'];
$checkedIdsArray = json_decode($checkedIdsString);
$placeholders = rtrim(str_repeat('?,', count($checkedIdsArray)), ',');

// echo $batchId;

$sql = "UPDATE users SET batch_id = ? WHERE id IN ($placeholders)";

// Prepare the statement
$stmt = $dbh->prepare($sql);

// Bind the batch ID parameter
$stmt->bindParam(1, $batchId, PDO::PARAM_STR);

// Bind each ID parameter for the IN clause
foreach ($checkedIdsArray as $key => $value) {
    $stmt->bindValue(($key + 2), $value, PDO::PARAM_INT);
}

// Execute the statement
if ($stmt->execute()) {
    $response = array("success" => true, "message" => "Update successful");
} else {
    $response = array("success" => false, "message" => "Error updating record: " . $stmt->errorInfo()[2]);
}

header('Content-Type: application/json');
echo json_encode($response);
}




if (isset($_GET['student_attendance']) && $_GET['student_attendance'] === '1') {
    $status = $_POST['status'];
    // Decode the JSON data
    $data = json_decode($_POST['checkedIdsAndBatchCode'], true);
    
    // Prepare the SQL statement to check if a record exists for each user
    $checkSql = "SELECT COUNT(*) as count FROM `attendance` WHERE `user_id` = ? AND DATE(`date`) = CURDATE()";
    $checkStmt = $dbh->prepare($checkSql);
    
    // Prepare the SQL statement for insertion
    $insertSql = "INSERT INTO `attendance` (`user_id`, `batch_id`, `course_id`, `status`, `date`, `created_at`, `updated_at`) 
                  VALUES (?, ?, ?, ?, NOW(), NOW(), NOW())";
    $insertStmt = $dbh->prepare($insertSql);
    
    // Prepare the SQL statement for update
    $updateSql = "UPDATE `attendance` SET `status` = ?, `updated_at` = NOW() WHERE `user_id` = ? AND DATE(`date`) = CURDATE()";
    $updateStmt = $dbh->prepare($updateSql);
    
    // Process each data item
    foreach ($data as $item) {
        $userId = $item['userId'];
        $batchId = $item['batchId'];
        $courseId = $item['courseId'];
        
        $checkStmt->execute([$userId]);
        $row = $checkStmt->fetch(PDO::FETCH_ASSOC);
        $count = $row['count'];
        
        if ($count > 0) {
            try {
                $updateStmt->execute([$status, $userId]);
            } catch (PDOException $e) {
                // Handle update error
                echo "Error updating record: " . $e->getMessage();
            }
        } else {
            // If no record exists, insert a new record
            try {
                $insertStmt->execute([$userId, $batchId, $courseId, $status]);
            } catch (PDOException $e) {
                // Handle insertion error
                echo "Error inserting record: " . $e->getMessage();
            }
        }
    }
    $response = array("success" => true, "message" => "Attendance records inserted/updated successfully");
    header('Content-Type: application/json');
    echo json_encode($response);

}


if (isset($_GET['staffBatch']) && $_GET['staffBatch'] === '1') {
    if (isset($_POST['checkedIdsAndBatchCode'])) {
        $json_data = $_POST['checkedIdsAndBatchCode'];
        $data = json_decode($json_data, true);

        if ($data !== null && is_array($data)) {
            try {
                // Begin transaction for atomicity
                $dbh->beginTransaction();

                foreach ($data as $item) {
                    $userId = $item['userId'];
                    $selectValues = $item['selectValue'];

                    foreach ($selectValues as $batchId) {
                        // Check if the entry already exists
                        $sql_check = "SELECT COUNT(*) FROM teacher_batches WHERE teacher_id = :teacher_id AND batch_id = :batch_id";
                        $stmt_check = $dbh->prepare($sql_check);
                        $stmt_check->bindParam(':teacher_id', $userId, PDO::PARAM_INT);
                        $stmt_check->bindParam(':batch_id', $batchId, PDO::PARAM_INT);
                        $stmt_check->execute();
                        $count = $stmt_check->fetchColumn();

                        if ($count == 0) {
                            // Insert only if the entry does not exist
                            $sql_insert = "INSERT INTO teacher_batches (teacher_id, batch_id) VALUES (:teacher_id, :batch_id)";
                            $stmt_insert = $dbh->prepare($sql_insert);
                            $stmt_insert->bindParam(':teacher_id', $userId, PDO::PARAM_INT);
                            $stmt_insert->bindParam(':batch_id', $batchId, PDO::PARAM_INT);
                            $stmt_insert->execute();
                        }
                    }
                }

                // Commit the transaction if all inserts are successful
                $dbh->commit();

                $response = array("success" => true, "message" => "Data inserted successfully");
            } catch(PDOException $e) {
                $dbh->rollBack();
                $response = array("success" => false, "message" => "Database error: " . $e->getMessage());
            }
        } else {
            $response = array("success" => false, "message" => "Failed to decode JSON data or incorrect format");
        }
    } else {
        $response = array("success" => false, "message" => "No data received");
    }
    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} 




if (isset($_GET['staffDelete']) && $_GET['staffDelete'] === '1') {
    // Check if 'checkedIdsAndBatchCode' is set and not empty
      // Check if 'userId' and 'batchId' are set in $_POST
      if (isset($_POST['userId']) && isset($_POST['batchId'])) {
        // Sanitize and validate inputs if needed
        $userId = $_POST['userId'];
        $batchId = $_POST['batchId'];

        try {
            // Prepare SQL statement to delete based on userId and batchId
            $sql = "DELETE FROM teacher_batches WHERE teacher_id = :userId AND batch_id = :batchId";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':batchId', $batchId, PDO::PARAM_INT);
            $stmt->execute();

            // Check if any rows were affected
            $rowCount = $stmt->rowCount();
            if ($rowCount > 0) {
                $response = array("success" => true, "message" => "Record deleted successfully");
            } else {
                $response = array("success" => false, "message" => "No matching record found to delete");
            }
        } catch(PDOException $e) {
            // Handle database errors
            $response = array("success" => false, "message" => "Database error: " . $e->getMessage());
        }
    } else {
        // Missing userId or batchId in $_POST
        $response = array("success" => false, "message" => "Missing userId or batchId in POST data");
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    } 
 



// Return JSON response
?>