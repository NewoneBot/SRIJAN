<?php 
// include 'config.php';

// Check if form is submitted
if (isset($_POST['register'])) {
  try {
      // Retrieve form data
      $f_name = $_POST['f_name'];
      $l_name = $_POST['l_name'];
      $email = $_POST['email'];
      $father_name = $_POST['father_name'];
      $father_husband_occupation = $_POST['fho'];
      $phone = $_POST['phone'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $pincode = $_POST['pincode'];
      $qualification = $_POST['qualification'];
      $gender = $_POST['gender'];
      $created_at = date("Y-m-d H:i:s");
      $new_admission = "1";

      // Handle file uploads
      $target_dir = "uploads/profile/";
      $photo_path = $target_dir . basename($_FILES["photo"]["name"]);
      $certificate_path = $target_dir . basename($_FILES["certificate"]["name"]);
      $adhar_path = $target_dir . basename($_FILES["adhar"]["name"]);
      $sign_path = $target_dir . basename($_FILES["sign"]["name"]);

      move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_path);
      move_uploaded_file($_FILES["certificate"]["tmp_name"], $certificate_path);
      move_uploaded_file($_FILES["adhar"]["tmp_name"], $adhar_path);
      move_uploaded_file($_FILES["sign"]["tmp_name"], $sign_path);

      // Update query
      $sql = "UPDATE users SET 
                  f_name = ?, 
                  l_name = ?, 
                  email = ?, 
                  fth_name = ?, 
                  fth_occuption = ?, 
                  phone = ?, 
                  addres = ?, 
                  state = ?, 
                  pincode = ?, 
                  gender = ?, 
                  qualification = ?, 
                  photo = ?, 
                  certificate = ?, 
                  adhar = ?, 
                  sign = ?, 
                  new_addmession = ?, 
                  created_at = ? 
              WHERE id = ?";

      // Prepare the statement
      $stmt = $dbh->prepare($sql);

      // Bind parameters
      $stmt->bindParam(1, $f_name);
      $stmt->bindParam(2, $l_name);
      $stmt->bindParam(3, $email);
      $stmt->bindParam(4, $father_name);
      $stmt->bindParam(5, $father_husband_occupation);
      $stmt->bindParam(6, $phone);
      $stmt->bindParam(7, $city);
      $stmt->bindParam(8, $state);
      $stmt->bindParam(9, $pincode);
      $stmt->bindParam(10, $gender);
      $stmt->bindParam(11, $qualification);
      $stmt->bindParam(12, $photo_path);
      $stmt->bindParam(13, $certificate_path);
      $stmt->bindParam(14, $adhar_path);
      $stmt->bindParam(15, $sign_path);
      $stmt->bindParam(16, $new_admission);
      $stmt->bindParam(17, $created_at);
      $stmt->bindParam(18, $user_id);

      // Execute the query
      if ($stmt->execute()) {
          // Update successful
          header("Location: application_report.php");
          exit;
      } else {
          echo "Error updating record: " . $stmt->errorInfo();
      }
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
}



if(isset($_POST['staff_creation'])) {

$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$email = $_POST['email'];
$password = $_POST['password']; // corrected variable name
$phone = $_POST['phone'];
$address = $_POST['address']; // corrected variable name

// Example of preparing a SQL statement (adjust table and columns as per your schema)
$stmt = $dbh->prepare("INSERT INTO `users` (`f_name`, `l_name`, `email`, `password`, `phone`, `addres`, `login_type`,
`created_at`)
VALUES
(:f_name, :l_name, :email, :password, :phone, :address, 0, NOW())");

// Bind parameters
$stmt->bindParam(':f_name', $f_name);
$stmt->bindParam(':l_name', $l_name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':phone', $phone);
$stmt->bindParam(':address', $address);


if ($stmt->execute()) {
header("Location: insertStaff.php");
exit;
} else {

echo "Error inserting record: " . $stmt->errorInfo()[2];
}
}


if (isset($_POST['edit'])) {
    try {
        // Retrieve form data
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];

        // Handle file uploads
        $target_dir = "uploads/profile/";
        $photo_path = $target_dir . basename($_FILES["photo"]["name"]);

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_path)) {
            // Update query
            $sql = "UPDATE users SET 
                        f_name = ?, 
                        l_name = ?, 
                        email = ?, 
                        password = ?, 
                        phone = ?, 
                        addres = ?, 
                        photo = ?
                    WHERE id = ?";

            // Prepare the statement
            $stmt = $dbh->prepare($sql);

            // Bind parameters
            $stmt->bindParam(1, $f_name);
            $stmt->bindParam(2, $l_name);
            $stmt->bindParam(3, $email);
            $stmt->bindParam(4, $password);
            $stmt->bindParam(5, $phone);
            $stmt->bindParam(6, $city);
            $stmt->bindParam(7, $photo_path);
            $stmt->bindParam(8, $user_id); // Assuming $user_id is defined somewhere

            // Execute the query
            if ($stmt->execute()) {
                // Update successful
                header("Location: index.php");
                exit;
            } else {
                echo "Error updating record: " . implode(", ", $stmt->errorInfo());
            }
        } else {
            echo "Error uploading file.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// if(isset($_POST['edit'])) {
// $f_name = $_POST['f_name'];
// $l_name = $_POST['l_name'];
// $email = $_POST['email'];
// $password = $_POST['password'];
// $phone = $_POST['phone'];
// $city = $_POST['city'];
// $photo_data = file_get_contents($_FILES['photo']['tmp_name']);

// $target_dir = "uploads/profile/";
// $photo_path = $target_dir.basename($_FILES["photo"]["name"]);

// move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_path);


// $sql = "UPDATE users SET
// f_name = ?,
// l_name = ?,
// email = ?,
// password = ?,
// phone = ?,
// addres = ?,
// photo = ?
// WHERE id = ?";

// // Prepare the statement
// $stmt = $dbh->prepare($sql);

// // Bind parameters
// $stmt->bindParam(1, $f_name);
// $stmt->bindParam(2, $l_name);
// $stmt->bindParam(3, $email);
// $stmt->bindParam(4, $password);
// $stmt->bindParam(5, $phone);
// $stmt->bindParam(6, $city);
// $stmt->bindParam(7, $photo_data);
// $stmt->bindParam(8, $user_id); // Assuming $user_id is defined somewhere

// // Execute the query
// if ($stmt->execute()) {
// // Update successful
// header("Location: index.php");
// exit;
// } else {
// echo "Error updating record: " . $stmt->errorInfo();
// }
// }


if(isset($_POST['assignment'])) {
$assignment_name = $_POST['assignment_name'];
$assignment_description = $_POST['assignment_description'];

// Check if file is uploaded
if(isset($_FILES['pdf_file'])) {
$pdf_file_name = uniqid() . '_' . $_FILES['pdf_file']['name']; // Generating a unique filename
$pdf_file_tmp = $_FILES['pdf_file']['tmp_name'];

// Move the uploaded file to a directory
move_uploaded_file($pdf_file_tmp, 'uploads/' . $pdf_file_name);

// Insert data into the database
$stmt = $dbh->prepare("INSERT INTO `assignments`(`user_id`, `name`, `textarea`, `pdf_file`) VALUES (:user_id, :name,
:textarea, :pdf_file)");
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':name', $assignment_name);
$stmt->bindParam(':textarea', $assignment_description);
$stmt->bindParam(':pdf_file', $pdf_file_name);
$stmt->execute();

header("Location: student_assignement.php");

} else {
echo 'File not uploaded';
}
}


if(isset($_POST['assignmentDelete'])) {
$assignment_id = $_POST['assignment_id'];
$stmt = $dbh->prepare("DELETE FROM assignments WHERE id = :assi_id");
$stmt->bindParam(':assi_id', $assignment_id);
$stmt->execute();
}


if(isset($_POST['batch_creation'])) {

$batch_code = $_POST['batch_code'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$course_id = $_POST['course_id'];
$is_active = '1';

if($course_id==='1'){
$batch_day = 'Wednesday & Friday';
}else if($course_id==='2'){
$batch_day = 'Monday, Wednesday, Friday & Saturday';
}else if($course_id==='3'){
$batch_day = 'Tuesday, Thursday, and Saturday';
}

$stmt = $dbh->prepare("INSERT INTO `batch`(`batch_code`, `start_batch`, `end_batch`, `batch_day`, `start_date`,
`end_date`, `course_id`, `is_active`) VALUES (:batch_code, :start_time, :end_time, :batch_day, :start_date, :end_date,
:course_id, :is_active)");
$stmt->bindParam(':batch_code', $batch_code);
$stmt->bindParam(':start_time', $start_time);
$stmt->bindParam(':end_time', $end_time);
$stmt->bindParam(':batch_day', $batch_day); // You need to define batch_day
$stmt->bindParam(':start_date', $start_date);
$stmt->bindParam(':end_date', $end_date);
$stmt->bindParam(':course_id', $course_id); // You need to define course_id
$stmt->bindParam(':is_active', $is_active); // You need to define is_active
$stmt->execute();
header("Location: createBatch.php");
}



if(isset($_POST['assingMeeting'])){
$classTime = $_POST['c_title'];
$classUrl = $_POST['c_url'];
$meeting_id = $_POST['meeting_id'];
$classPass = $_POST['c_pass'];
$classBatch = $_POST['batch_id'];

// Assuming $conn is your PDO connection
$stmt = $dbh->prepare("
INSERT INTO meetings (class_title,meeting_id, meeting_url, password, batch)
VALUES (:class_title,:meeting_id, :meeting_url, :password, :batch)
ON DUPLICATE KEY UPDATE
class_title = VALUES(class_title),
meeting_id = VALUES(meeting_id),
meeting_url = VALUES(meeting_url),
password = VALUES(password)
");

$stmt->bindValue(':class_title', $classTime);
$stmt->bindValue(':meeting_id', $meeting_id);
$stmt->bindValue(':meeting_url', $classUrl);
$stmt->bindValue(':password', $classPass);
$stmt->bindValue(':batch', $classBatch);

$stmt->execute();
header("Location: meetingCreation.php");

}

// ---------------------------------------------------------------->

if (isset($_POST['product_insert'])) {
$p_name = $_POST['p_name'];
$p_price = $_POST['p_price'];
$description = $_POST['desc'];
$category = $_POST['course_id'];

// Function to generate a unique SKU
function generateSKU($dbh) {
$prefix = 'SKU';
$unique = false;
$sku = '';

while (!$unique) {
$sku = $prefix . mt_rand(10000, 99999);
$stmt = $dbh->prepare("SELECT COUNT(*) FROM products WHERE product_id = :product_id");
$stmt->bindValue(':product_id', $sku);
$stmt->execute();
$count = $stmt->fetchColumn();
if ($count == 0) {
$unique = true;
}
}

return $sku;
}

$product_id = generateSKU($dbh);

$img_file_name = null;
if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
$img_tmp_name = $_FILES['img']['tmp_name'];
$img_name = basename($_FILES['img']['name']);
$img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
$target_dir = "uploads/";
$img_file_name = $product_id . '.' . $img_ext;
$target_file = $target_dir . $img_file_name;

if (!is_dir($target_dir)) {
mkdir($target_dir, 0777, true);
}

move_uploaded_file($img_tmp_name, $target_file);
}
try {
$stmt = $dbh->prepare("INSERT INTO products (product_id, name, description, price, category, p_img, created_at,
updated_at) VALUES (:product_id, :name, :description, :price, :category, :p_img, NOW(), NOW())");

$stmt->bindValue(':product_id', $product_id);
$stmt->bindValue(':name', $p_name);
$stmt->bindValue(':description', $description);
$stmt->bindValue(':price', $p_price);
$stmt->bindValue(':category', $category);
$stmt->bindValue(':p_img', $img_file_name);

$stmt->execute();
header("Location: insertProduct.php");
} catch (PDOException $e) {
echo "Error: " . $e->getMessage();
}
}

if (isset($_POST['product_update'])) {
$product_id = $_GET['product_id'];
$p_name = $_POST['p_name'];
$p_price = $_POST['p_price'];
$description = $_POST['desc'];
$category = $_POST['course_id'];

$img_file_name = null;
if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
$img_tmp_name = $_FILES['img']['tmp_name'];
$img_name = basename($_FILES['img']['name']);
$img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
$target_dir = "uploads/";
$img_file_name = $product_id . '.' . $img_ext;
$target_file = $target_dir . $img_file_name;

if (!is_dir($target_dir)) {
mkdir($target_dir, 0777, true);
}

move_uploaded_file($img_tmp_name, $target_file);
}

try {
if ($img_file_name) {
$stmt = $dbh->prepare("UPDATE products SET name = :name, description = :description, price = :price, category =
:category, p_img = :p_img, updated_at = NOW() WHERE id = :product_id");
$stmt->bindValue(':p_img', $img_file_name);
} else {
$stmt = $dbh->prepare("UPDATE products SET name = :name, description = :description, price = :price, category =
:category, updated_at = NOW() WHERE id = :product_id");
}

$stmt->bindValue(':product_id', $product_id);
$stmt->bindValue(':name', $p_name);
$stmt->bindValue(':description', $description);
$stmt->bindValue(':price', $p_price);
$stmt->bindValue(':category', $category);

$stmt->execute();
header("Location: insertProduct.php");
} catch (PDOException $e) {
echo "Error: " . $e->getMessage();
}
}



if (isset($_POST['product_delete'])) {
$product_id = $_POST['product_id'];

try {
// Delete the product from the database
$stmt = $dbh->prepare("DELETE FROM products WHERE id = :product_id");
$stmt->bindValue(':product_id', $product_id);
$stmt->execute();

// Optionally, delete the associated image file if it exists
$target_dir = "uploads/";
$target_file = $target_dir . $product_id . '.*';
array_map('unlink', glob($target_file));

header("Location: insertProduct.php");
} catch (PDOException $e) {
echo "Error: " . $e->getMessage();
}
}


?>