<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>


    <?php include 'comman_include.php'; ?>

    <?php include 'style1.php'; ?>

    <link type="text/css"
        href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css"
        rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <style>
    .select.form-select {
        /* padding: 3 !important; */
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Creating Meeting Form</h4>
                            <form class="forms-sample row py-3" method="POST">
                                <div class="form-group col-12 col-md-6">
                                    <label for="c_title">Class Title</label>
                                    <input type="text" name="c_title" id="c_title" class="form-control form-control-sm"
                                        placeholder="Class Name" aria-label="Username">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="c_url">Meeting URL</label>
                                    <input type="text" id="c_url" name="c_url" class="form-control form-control-sm"
                                        placeholder="Class Meeting URL" aria-label="Past URL here">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="c_pass">Class Meeting ID</label>
                                    <input type="text" id="c_pass" name="meeting_id"
                                        class="form-control form-control-sm" placeholder="Class Room Password"
                                        aria-label="Past URL here">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="c_pass">Meeting Password</label>
                                    <input type="text" id="c_pass" name="c_pass" class="form-control form-control-sm"
                                        placeholder="Class Room Password" aria-label="Past URL here">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="batch_id">Select Batch to Assign Meeting</label>
                                    <select class="form-control form-select" id="batch_id" name="batch_id" required>
                                        <?php foreach ($batch_list as $course): ?>
                                        <option value="<?php echo $course['batch_code'];?>">
                                            <?php echo $course['batch_code'];?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6 pt-4">
                                    <button type="submit" name="assingMeeting"
                                        class="btn btn-gradient-primary me-2">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card p-3">
                        <div class="card-body p-2">
                            <h4 class="card-title">Create Meeting</h4>

                            <form id="myBatch" action="" method="post">
                                <div class="table-responsive">
                                    <table class="table p-3 mt-3 table-striped table-bordered" id="myTable">
                                        <thead class="thead-dark table-dark">
                                            <tr>
                                                <th class=" align-content-center justify-content-center">S.no.</th>
                                                <th> Student Batch</th>
                                                <th> Batch Title</th>
                                                <th> Meeting ID</th>
                                                <th> Meeting Password</th>
                                                <th> meeting URL</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($meeting_data as $meeting_data): ?>
                                            <tr>
                                                <td class="p-2 align-content-center justify-content-center">
                                                    <?php echo $meeting_data['id']; ?>
                                                </td>
                                                <td><?php echo $meeting_data['batch']; ?></td>

                                                <td><?php echo $meeting_data['class_title']; ?>
                                                </td>
                                                <td><?php echo $meeting_data['meeting_id']; ?></td>
                                                <td>
                                                    <?php echo $meeting_data['password']; ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo $meeting_data['meeting_url']; ?>">
                                                        <?php echo $meeting_data['meeting_url']; ?>
                                                    </a>
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