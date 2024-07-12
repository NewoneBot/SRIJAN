<?php 


// this is a users table --------------------------------------------->

$stmt = $dbh->prepare("
    SELECT 
        u.*, 
        cp.id AS course_plan_id, 
        cp.plan_name, 
        cp.course_name, 
        cp.price,
        cp.total_classes, 
        cp.billing_period, 
        cp.is_active AS course_plan_is_active,
        b.batch_code,
        b.start_batch,
        b.end_batch,
        b.batch_day,
        b.start_date,
        b.end_date,
        b.is_active AS batch_is_active,
        t.transaction_id,
        t.payment_method,
        t.amount,
        t.payment_id,
        t.transaction_date,
        m.id AS meeting_id, 
        m.class_title,
        m.meeting_id AS meeting_meeting_id, 
        m.meeting_url, 
        m.password AS meeting_password
    FROM 
        users u 
    LEFT JOIN 
        course_plan cp ON u.course_id = cp.id 
    LEFT JOIN 
        batch b ON u.batch_id = b.batch_code
    LEFT JOIN 
        transactions t ON u.id = t.user_id AND u.course_id = t.course_id
    LEFT JOIN 
        meetings m ON u.batch_id = m.batch
    WHERE 
        u.id = ?
");
    
    // Execute the statement with the user ID parameter
    $stmt->execute([$user_id]);
    
    // Fetch the result
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($_GET['view_id'])) {
        $viewStudent_id = $_GET['view_id'];
    
        // Prepare the SQL query
        $studentView = $dbh->prepare("
            SELECT 
                u.*, 
                cp.id AS course_plan_id, 
                cp.plan_name, 
                cp.course_name, 
                cp.price,
                cp.total_classes, 
                cp.billing_period, 
                cp.is_active AS course_plan_is_active,
                b.batch_code,
                b.start_batch,
                b.end_batch,
                b.batch_day,
                b.start_date,
                b.end_date,
                b.is_active AS batch_is_active,
                t.transaction_id,
                t.payment_method,
                t.amount,
                t.payment_id,
                t.transaction_date,
                m.id AS meeting_id, 
                m.class_title,
                m.meeting_id AS meeting_meeting_id, 
                m.meeting_url, 
                m.password AS meeting_password
            FROM 
                users u 
            LEFT JOIN 
                course_plan cp ON u.course_id = cp.id 
            LEFT JOIN 
                batch b ON u.batch_id = b.batch_code
            LEFT JOIN 
                transactions t ON u.id = t.user_id AND u.course_id = t.course_id
            LEFT JOIN 
                meetings m ON u.batch_id = m.batch
            WHERE 
                u.id = ?
        ");
        
        // Execute the statement with the user ID parameter
        $studentView->execute([$viewStudent_id]);
        
        // Fetch the result
        $viewUser = $studentView->fetch(PDO::FETCH_ASSOC);
    
        // Now $user contains the data for the user with ID = $user_id
        // You can use $user['column_name'] to access individual fields from the query result
    } 

// transaction id and data ---------------------------------------->
$strtransaction = $dbh->prepare("
    SELECT 
        t.*,
        cp.id AS course_plan_id, 
        cp.plan_name, 
        cp.course_name, 
        cp.price,
        cp.total_classes, 
        cp.billing_period 
    FROM     
        transactions t
    LEFT JOIN 
        course_plan cp ON t.course_id = cp.id 
    WHERE 
        t.user_id = ?
");

// Use $_GET['view_id'] if it is set, otherwise use $user_id
$view_id = isset($_GET['view_id']) ? $_GET['view_id'] : $user_id;

// Execute the query with the $view_id parameter
$strtransaction->execute([$view_id]);

// Fetch all results
$userTransaction = $strtransaction->fetchAll(PDO::FETCH_ASSOC);
// $strtransaction = $dbh->prepare("
//     SELECT 
//         u.*, 
//         cp.id AS course_plan_id, 
//         cp.plan_name, 
//         cp.course_name, 
//         cp.price,
//         cp.total_classes, 
//         cp.billing_period, 
//         cp.is_active,
//         t.transaction_id,
//         t.payment_method,
//         t.amount,
//         t.payment_id,
//         t.transaction_date,
//         t.course_id
//     FROM 
//         users u 
//     LEFT JOIN 
//         transactions t ON u.id = t.user_id
//     LEFT JOIN 
//         course_plan cp ON t.course_id = cp.id 
//     WHERE 
//         u.id = ?
// ");

// // Use $_GET['view_id'] if it is set, otherwise use $user_id
// $view_id = isset($_GET['view_id']) ? $_GET['view_id'] : $user_id;

// $strtransaction->execute([$view_id]);
// $userTransaction = $strtransaction->fetchAll(PDO::FETCH_ASSOC);



// $strtransaction = $dbh->prepare("
//     SELECT 
//         u.*, 
//         cp.id AS course_plan_id, 
//         cp.plan_name, 
//         cp.course_name, 
//         cp.price,
//         cp.total_classes, 
//         cp.billing_period, 
//         cp.is_active,
//         t.transaction_id,
//         t.payment_method,
//         t.amount,
//         t.payment_id,
//         t.transaction_date,
//         t.course_id
//     FROM 
//         users u 
//     LEFT JOIN 
//         transactions t ON u.id = t.user_id
//     LEFT JOIN 
//         course_plan cp ON t.course_id = cp.id 
//     WHERE 
//         u.id = ?
// ");
// $strtransaction->execute([$user_id]);
// $userTransaction = $strtransaction->fetchAll(PDO::FETCH_ASSOC);

// Display the course name with transaction IDs

// master query ------------------------------------------------------->

if(isset($_POST['filter'])) {
    $params = [2];
    $where_clause = "";
    
    if ($_POST['course_id'] != '0' && isset($_POST['course_id']) && !empty($_POST['course_id'])) {
        $course_id = $_POST['course_id'];
        $where_clause .= " AND u.course_id = ?";
        $params[] = $course_id;
    }
    
    if (isset($_POST['batch_id']) && $_POST['batch_id'] != 'NA') {
        $batch_id = $_POST['batch_id'];
        $where_clause .= " AND u.batch_id = ?";
        $params[] = $batch_id;
    }
    
    if (isset($_POST['start_date']) && !empty($_POST['start_date'])) {
        $start_date = $_POST['start_date'];
        $where_clause .= " AND u.created_at >= ?";
        $params[] = $start_date;
    }
    
    if (isset($_POST['end_date']) && !empty($_POST['end_date'])) {
        $end_date = $_POST['end_date'];
        $where_clause .= " AND u.created_at <= ?";
        $params[] = $end_date;
    }
    
    if (isset($_POST['fee_status']) && ($_POST['fee_status'] == '0' || $_POST['fee_status'] == '1')) {
        $fee_status = $_POST['fee_status'];
        if ($fee_status == '1') {
            // Paid students
            $where_clause .= " AND u.payment = 1";
        } else {
            // Unpaid students
            $where_clause .= " AND u.payment = 0";
        }
    }
    
    $query = "
        SELECT u.*, cp.id AS course_plan_id, cp.plan_name, cp.course_name, cp.price, cp.billing_period, cp.is_active,
        a.status AS attendance_status, a.date AS attendance_date
        FROM users u 
        LEFT JOIN course_plan cp ON u.course_id = cp.id 
        LEFT JOIN (
            SELECT user_id, MAX(date) AS max_date
            FROM attendance
            GROUP BY user_id
        ) latest_attendance ON u.id = latest_attendance.user_id
        LEFT JOIN attendance a ON u.id = a.user_id AND a.date = latest_attendance.max_date
        WHERE u.login_type = ? $where_clause
        ORDER BY u.id DESC;
    ";
    
    $student = $dbh->prepare($query);
    
    if (!$student->execute($params)) {
        echo "Error: " . $student->errorInfo()[2];
    } else {
        $student_data = $student->fetchAll(PDO::FETCH_ASSOC);
    }
} 

else {
    // Fetch all data
    $student = $dbh->prepare("
        SELECT u.*, cp.id AS course_plan_id, cp.plan_name, cp.course_name, cp.price, cp.billing_period, cp.is_active,
        a.status AS attendance_status, a.date AS attendance_date
        FROM users u 
        LEFT JOIN course_plan cp ON u.course_id = cp.id 
        LEFT JOIN (
            SELECT user_id, MAX(date) AS max_date
            FROM attendance
            GROUP BY user_id
        ) latest_attendance ON u.id = latest_attendance.user_id
        LEFT JOIN attendance a ON u.id = a.user_id AND a.date = latest_attendance.max_date
        WHERE u.login_type = ? 
        ORDER BY u.id DESC;
    ");

    // Correct the number of parameters passed to the execute method
    if (!$student->execute([2])) {
        echo "Error: " . $student->errorInfo()[2];
    } else {
        $student_data = $student->fetchAll(PDO::FETCH_ASSOC);
    }
}



$countQuery = $dbh->prepare("
SELECT COUNT(*) AS total_students
FROM users
WHERE login_type = ? ;
");

// Execute the count query and check for errors
if (!$countQuery->execute([2])) {
echo "Error: " . $countQuery->errorInfo()[2];
} else {
// Fetch the total count of students
$totalStudentCount = $countQuery->fetch(PDO::FETCH_ASSOC)['total_students'];

}
 


// Fetch total new student count
$new_student_count = $dbh->prepare("
    SELECT COUNT(*) AS total_new_students
    FROM users
    WHERE login_type = ? AND payment = 1 AND new_addmession = 1
");

if (!$new_student_count->execute([2])) {
    echo "Error: " . $new_student_count->errorInfo()[2];
} else {
    $new_student_count_data = $new_student_count->fetch(PDO::FETCH_ASSOC);
    $total_new_students = $new_student_count_data['total_new_students'];
}










// meeting table ------------------------------->


$meetingBatch = $dbh->prepare("
    SELECT `id`, `batch`, `class_title`, `meeting_id`, `meeting_url`, `password` FROM `meetings`
");

$meetingBatch->execute(); // Execute the prepared statement

$meeting_data = $meetingBatch->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows as associative array

// Now $meeting_data contains the result of your query


// Attandance table for students ---------------->


if(isset($_POST['filter'])) {
    $params = [2];
    $where_clause = "";
    
    if(isset($_POST['course_id']) != '0') {
        if(isset($_POST['course_id']) && !empty($_POST['course_id'])) {
            $course_id = $_POST['course_id'];
            $where_clause .= " AND u.course_id = ?";
            $params[] = $course_id;
        }
    }

    if(isset($_POST['batch_id']) && $_POST['batch_id'] != '0') {
        $batch_id = $_POST['batch_id'];
        $where_clause .= " AND u.batch_id = ?";
        $params[] = $batch_id;
    }

    if(isset($_POST['start_date']) && !empty($_POST['start_date'])) {
        $start_date = $_POST['start_date'];
        $where_clause .= " AND u.created_at >= ?";
        $params[] = $start_date;
    }

    if(isset($_POST['end_date']) && !empty($_POST['end_date'])) {
        $end_date = $_POST['end_date'];
        $where_clause .= " AND u.created_at <= ?";
        $params[] = $end_date;
    }

    $query = "
    SELECT u.*, cp.id AS course_plan_id, cp.plan_name, cp.course_name, cp.total_classes ,cp.price, cp.billing_period, cp.is_active,
    a.status AS attendance_status, a.date AS attendance_date
FROM users u 
LEFT JOIN course_plan cp ON u.course_id = cp.id 
LEFT JOIN (
 SELECT user_id, MAX(date) AS max_date
 FROM attendance
 GROUP BY user_id
) latest_attendance ON u.id = latest_attendance.user_id
LEFT JOIN attendance a ON u.id = a.user_id AND a.date = latest_attendance.max_date
WHERE u.login_type = ? AND u.payment = 1
$where_clause
ORDER BY u.id DESC;
";


    $student = $dbh->prepare($query);

    if (!$student->execute($params)) {
        echo "Error: " . $student->errorInfo()[2];
    } else {
        $student_data_attandance = $student->fetchAll(PDO::FETCH_ASSOC);
    }
} else {
    // Fetch all data
    $student = $dbh->prepare("
    SELECT u.*, 
    a.status AS attendance_status, a.date AS attendance_date
FROM users u 
LEFT JOIN course_plan cp ON u.course_id = cp.id 
LEFT JOIN (
 SELECT user_id, MAX(date) AS max_date
 FROM attendance
 GROUP BY user_id
) latest_attendance ON u.id = latest_attendance.user_id
LEFT JOIN attendance a ON u.id = a.user_id AND a.date = latest_attendance.max_date
WHERE u.login_type = ? AND u.payment = 1 
ORDER BY u.id DESC;
");

    if (!$student->execute([2])) {
        echo "Error: " . $student->errorInfo()[2];
    } else {
        $student_data_attandance = $student->fetchAll(PDO::FETCH_ASSOC);
    }
}

if(isset($_POST['filter_staff'])) {
   
} else {
    $staff = $dbh->prepare("
    SELECT u.*, GROUP_CONCAT(tb.batch_id ORDER BY tb.batch_id ASC SEPARATOR ', ') AS batches
    FROM users u
    LEFT JOIN teacher_batches tb ON u.id = tb.teacher_id
    WHERE u.login_type = 0
    GROUP BY u.id
    ORDER BY u.id DESC;    
");

if (!$staff->execute()) {
    echo "Error: " . $staff->errorInfo()[2];
} else {
    $staffList = $staff->fetchAll(PDO::FETCH_ASSOC);

    $countQuery = $dbh->prepare("
        SELECT COUNT(*) AS total
        FROM users
        WHERE login_type = 0;
    ");
    $countQuery->execute();
    $totalStaffCount = $countQuery->fetch(PDO::FETCH_ASSOC)['total'];

    // echo "Total count of staff: " . $totalCount;
}
}


// attandance table..........................................>


if(isset($_POST['filter'])) {
  
}
else {
    $user_course = $user['course_id'];
    $studentAttendance = $dbh->prepare("
    SELECT * FROM `attendance` WHERE user_id = :user_id AND course_id = $user_course ORDER BY date DESC
");
if (!$studentAttendance->execute([':user_id' => $user_id])) {
    echo "Error: " . $studentAttendance->errorInfo()[2];
} else {
    $student_attandace_data = $studentAttendance->fetchAll(PDO::FETCH_ASSOC);
}

$studentAttendanceSummary = $dbh->prepare("
    SELECT 
        SUM(CASE WHEN status = 'p' THEN 1 ELSE 0 END) as present_count,
        SUM(CASE WHEN status = 'a' THEN 1 ELSE 0 END) as absent_count
    FROM `attendance` 
    WHERE user_id = :user_id AND course_id = $user_course   
");

if (!$studentAttendanceSummary->execute([':user_id' => $user_id])) {
    echo "Error: " . $studentAttendanceSummary->errorInfo()[2];
} else {
    $row = $studentAttendanceSummary->fetch(PDO::FETCH_ASSOC);
    $present_count = $row['present_count'];
    $absent_count = $row['absent_count'];
  }
}


// if(isset($_POST['filter'])) {
  
// }
// else {
//     $studentAttendance = $dbh->prepare("
//     SELECT * FROM `attendance` WHERE user_id = :user_id ORDER BY date DESC
// ");

// if (!$studentAttendance->execute([':user_id' => $user_id])) {
//     echo "Error: " . $studentAttendance->errorInfo()[2];
// } else {
//     $student_attandace_data = $studentAttendance->fetchAll(PDO::FETCH_ASSOC);
// }

// $studentAttendanceSummary = $dbh->prepare("
//     SELECT 
//         SUM(CASE WHEN status = 'p' THEN 1 ELSE 0 END) as present_count,
//         SUM(CASE WHEN status = 'a' THEN 1 ELSE 0 END) as absent_count
//     FROM `attendance` 
//     WHERE user_id = :user_id
// ");

// if (!$studentAttendanceSummary->execute([':user_id' => $user_id])) {
//     echo "Error: " . $studentAttendanceSummary->errorInfo()[2];
// } else {
//     $row = $studentAttendanceSummary->fetch(PDO::FETCH_ASSOC);
//     $present_count = $row['present_count'];
//     $absent_count = $row['absent_count'];
//   }
// }









// this is a course table query --------------------------------------->

$sql = "SELECT * FROM course_plan";
if (isset($_GET['course_id'])) {
    $sql .= " WHERE id = :course_id";
}
$stmt1 = $dbh->prepare($sql);
if (isset($_GET['course_id'])) {
    $stmt1->bindParam(':course_id', $_GET['course_id']);
}
$stmt1->execute();
$courses = $stmt1->fetchAll(PDO::FETCH_ASSOC);




// this is a aggigenemt query --------------------------------------->


$assignments = "SELECT * FROM assignments WHERE user_id = :user_id";
$assignments = $dbh->prepare($assignments);
$assignments->execute(['user_id' => $user_id]); // Passing the parameter as an associative array
$u_assign = $assignments->fetchAll(PDO::FETCH_ASSOC);



$AllAssignments = "SELECT assignments.*, users.* 
        FROM assignments 
        JOIN users ON assignments.user_id = users.id";
$AllAssignments = $dbh->prepare($AllAssignments);
$AllAssignments->execute();
$u_AllAssignments = $AllAssignments->fetchAll(PDO::FETCH_ASSOC);



// batchs query -------------------------------------------------------->

$batch_list_query = "SELECT b.*, cp.id AS plan_id, cp.plan_name, cp.course_name, cp.price, cp.billing_period, cp.class_timing, cp.traning_hours, cp.is_active 
                    FROM batch b 
                    LEFT JOIN course_plan cp ON b.course_id = cp.id";

$batch_list_statement = $dbh->prepare($batch_list_query);
$batch_list_statement->execute();
$batch_list = $batch_list_statement->fetchAll(PDO::FETCH_ASSOC);




// product query ---------------------------------------------------------->


$product_query = "SELECT * FROM products WHERE 1";
$product_query = $dbh->prepare($product_query);
$product_query->execute();

// Fetch all products
$product_list = $product_query->fetchAll(PDO::FETCH_ASSOC);


    $product = [];
    if (isset($_GET['product_id'])) {
        $product_edit_query = "SELECT * FROM products WHERE id = :product_id";
        $product_edit_stmt = $dbh->prepare($product_edit_query);
        $product_edit_stmt->bindParam(':product_id', $_GET['product_id'], PDO::PARAM_INT);
        $product_edit_stmt->execute();
        $product = $product_edit_stmt->fetch(PDO::FETCH_ASSOC);
    }


    $course_query = "SELECT * FROM course_plan WHERE 1";
$course_stmt = $dbh->prepare($course_query);
$course_stmt->execute();
$courses_list = $course_stmt->fetchAll(PDO::FETCH_ASSOC);



// product query --------------------------------------------------------------->





?>