<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>


    <?php include 'comman_include.php'; ?>

    <?php include 'style1.php'; ?>


    <style>
    .select.form-select {
        border: 0;
        outline: 1px solid #ebedf2;
        color: #c9c8c8;
    }

    #myTable_filter label {
        float: right;
    }
    </style>



</head>

<body>


    <?php include 'navbar.php'; ?>
    <?php include 'sidebar.php'; ?>
    <?php if ($user['login_type'] == 1 || $user['login_type'] == 0) : ?>
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span>Student Attendance
                </h3>
            </div>

            <div class="row mt-2">
                <div class="card p-1">
                    <div class="card-body p-2">
                        <h4 class="card-title">
                            Filter
                        </h4>
                        <form method="post">
                            <div class="row mb-4 p-2">
                                <?php  if($user['login_type'] == 1){ ?>
                                <div class="col-3">
                                    <label for="exampleInputUsername1">Course</label>
                                    <select class="form-select w-100 my-2" name="course_id" required>
                                        <option
                                            <?php echo !isset($_POST['course_id']) || $_POST['course_id'] == '0' ? 'selected' : ''; ?>
                                            value="0">Select Course</option>
                                        <?php foreach ($courses as $course): ?>
                                        <option
                                            <?php echo isset($_POST['course_id']) && $_POST['course_id'] == $course['id'] ? 'selected' : ''; ?>
                                            value="<?php echo $course['id'];?>">
                                            <?php echo $course['course_name'];?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <?php  } ?>
                                <div class="col-3">
                                    <label for="exampleInputUsername1">Batch</label>
                                    <select class="form-select w-100 my-2" name="batch_id" id="batch_id" required>
                                        <option
                                            <?php echo !isset($_POST['batch_id']) || $_POST['batch_id'] == 'NA' ? 'selected' : ''; ?>
                                            value="NA">Select Batch</option>
                                        <option value="0">No Batch Assigin</option>
                                        <?php foreach ($batch_list as $batch): ?>
                                        <option
                                            <?php echo isset($_POST['batch_id']) && $_POST['batch_id'] == $batch['batch_code'] ? 'selected' : ''; ?>
                                            value="<?php echo $batch['batch_code'];?>">
                                            <?php echo $batch['batch_code'];?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-12 my-3 d-flex">
                                    <button type="submit" name="filter"
                                        class="btn btn-gradient-primary me-2 py-2">Search</button>
                                    <a class="btn btn-primary me-2 py-2" href="student_attendance.php">Reset</a>
                                </div>

                            </div>
                        </form>

                        <hr />
                        <form class="p-2" id="myBatch" action="">
                            <button type="button" class="btn btn-success py-2" id="presentBtn">Present</button>
                            <button type="button" class="btn btn-danger py-2" id="absentBtn">Absent</button>
                        </form>
                        <hr />

                        <form id="myBatch" action="" method="post">
                            <div class="table-responsive">
                                <table class="table p-3  table-striped table-bordered" id="myTable">
                                    <thead class="thead-dark table-dark">
                                        <tr>
                                            <th class=" align-content-center justify-content-center"></th>
                                            <th> Student Name </th>
                                            <th> Batch Id </th>
                                            <th> Course Id </th>
                                            <th> Attendance Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($student_data as $student_row): ?>
                                        <?php if ($student_row['payment'] == 0) continue; // Skip if payment is 0 ?>
                                        <tr>
                                            <td class="p-2 align-content-center justify-content-center">
                                                <?php echo $student_row['id']; ?>
                                            </td>
                                            <td><?php echo $student_row['f_name']; ?></td>

                                            <td data-batch-id="<?php echo $student_row['batch_id']; ?>">
                                                <?php
                if ($student_row['batch_id'] === '0') {
                    echo 'No Batch Assign Yet';
                } else {
                    echo $student_row['batch_id'];
                }
                ?>
                                            </td>
                                            <td><?php echo $student_row['course_id']; ?></td>
                                            <td>
                                                <?php
                // Assuming $student_row contains the data retrieved from the query

                $current_date = date('Y-m-d'); 
                if ($student_row['attendance_date'] === $current_date) {
                    if ($student_row['attendance_status'] === 'p') {
                        echo '<button type="button" class="btn btn-success w-50 p-2">Present</button>';
                    } else {
                        echo '<button type="button" class="btn btn-danger w-50 p-2">Absent</button>';
                    }
                } else {
                    // If the last inserted date is not the same as the current date, show the message that the class was not attended
                    echo 'Attendance Not Marked';
                }
                ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>

        <?php endif ?>

        <?php include 'script2.php'; ?>
        <!-- End custom js for this page -->
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css">

<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script type="text/javascript"
    src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
<script>
$(document).ready(function() {
    table = $('#myTable').DataTable({
        'columnDefs': [{
            'targets': 0,
            'checkboxes': {
                'selectRow': true
            }
        }],
        'select': {
            'style': 'multi'
        }, // Enable multiple row selection
        'order': [
            [0, 'asc']
        ], // Default sorting order
        'paging': true,
    });
});
</script>


<script>
document.getElementById("presentBtn").addEventListener("click", function() {
    handleButtonClick('p');
});

// Event listener for "Absent" button
document.getElementById("absentBtn").addEventListener("click", function() {
    handleButtonClick('a');
});

// Submit form function
function handleButtonClick(status) {
    var selected_row_data = table.column(0).checkboxes.selected();
    var selectedData = [];

    $.each(selected_row_data, function(key, rowIndex) {
        var rawData = table.row(key).data();
        var dataObject = {
            userId: rowIndex,
            batchId: rawData[2],
            courseId: rawData[3]
        };
        selectedData.push(dataObject);
    });

    console.log(selectedData);
    objectData = JSON.stringify(selectedData);

    var formData = {
        status: status,
        checkedIdsAndBatchCode: objectData
    };

    // For example:
    $.ajax({
        url: 'AjaxMutation.php?student_attendance=1',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            console.log(response)
            if (response) {
                console.log("data", response);
                // Refresh the page after successful update
                location.reload();
            } else {
                console.log("Error:", response);
            }
        },
        error: function(xhr, status, error) {
            console.log("Error:", error);
        }
    });
}
</script>




</html>