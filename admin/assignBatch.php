<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>


    <?php include 'comman_include.php'; ?>

    <?php include 'style1.php'; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css"
        integrity="sha512-rt/SrQ4UNIaGfDyEXZtNcyWvQeOq0QLygHluFQcSjaGB04IxWhal71tKuzP6K8eYXYB6vJV4pHkXcmFGGQ1/0w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.10/dayjs.min.js"
        integrity="sha512-FwNWaxyfy2XlEINoSnZh1JQ5TRRtGow0D6XcmAWmYCRgvqOUTnzCxPc9uF35u5ZEpirk1uhlPVA19tflhvnW1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer="defer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"
        integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer="defer"></script>
    <script src="js/timepicker-bs4.js?" defer="defer"></script>


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
    <?php if ($user['login_type'] == 1) : ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span>Create Batchs
                </h3>
            </div>



            <div class="row mt-2">
                <div class="card p-1">
                    <div class="card-body p-2">
                        <h4 class="card-title">Batch List</h4>
                        <table class="table table-striped table-bordered" id="">
                            <thead class="thead-dark table-dark">
                                <tr>
                                    <th> S.No. </th>
                                    <th> Batch Code</th>
                                    <th> Start Batch Time</th>
                                    <th> End Batch Time</th>
                                    <th> Start Date </th>
                                    <th> End Date </th>
                                    <th> Course </th>
                                    <th> Batch Day </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        $count = 1;
                                        foreach ($batch_list as $assign): ?>
                                <tr>
                                    <td class="justify-content-center">
                                        <?php echo $count; ?>
                                        <!-- Assuming 'id' is a column in your 'assignments' table -->
                                    </td>
                                    <td>
                                        <?php echo $assign['batch_code']; ?>
                                    </td>
                                    <td>
                                        <?php echo $assign['start_batch']; ?>
                                    </td>
                                    <td>
                                        <?php echo $assign['end_batch']; ?>
                                    </td>
                                    <td>
                                        <?php echo $assign['start_date']; ?>
                                    </td>
                                    <td>
                                        <?php echo $assign['end_date']; ?>
                                    </td>
                                    <td>
                                        <?php echo $assign['plan_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $assign['batch_day']; ?>
                                    </td>

                                </tr>
                                <?php 
                                        $count++;
                                        endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="row mt-2">
                <div class="card p-1">
                    <div class="card-body p-2">
                        <h4 class="card-title">Student Batch Assign</h4>

                        <form method="post">
                            <div class="form-row my-4 p-2">

                                <div class="col-3">
                                    <label for="inputZip">Start Date</label>
                                    <input type="date" class="form-control"
                                        value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>"
                                        name="start_date" placeholder="Start Date">
                                </div>
                                <div class="col-3">
                                    <label for="inputZip">End Date</label>
                                    <input type="date" class="form-control"
                                        value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>"
                                        name="end_date" placeholder="End Date">
                                </div>
                                <div class="col-3">
                                    <label for="exampleInputUsername1">Course</label>
                                    <select class="custom-select" name="course_id" required>
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

                                <div class="col-md-3 col-12">
                                    <label for="exampleInputUsername1">Batch</label>
                                    <select class="form-select w-100" name="batch_id" id="batch_id" required>
                                        <option value="NA"
                                            <?php echo (!isset($_POST['batch_id']) || $_POST['batch_id'] == 'NA') ? 'selected' : ''; ?>>
                                            Select Batch
                                        </option>
                                        <option value="0"
                                            <?php echo (isset($_POST['batch_id']) && $_POST['batch_id'] == '0') ? 'selected' : ''; ?>>
                                            No Batch Assign
                                        </option>
                                        <?php foreach ($batch_list as $batch): ?>
                                        <option value="<?php echo $batch['batch_code']; ?>"
                                            <?php echo (isset($_POST['batch_id']) && $_POST['batch_id'] == $batch['batch_code']) ? 'selected' : ''; ?>>
                                            <?php echo $batch['batch_code']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>



                                <div class="col-12 my-3 d-flex">
                                    <button type="submit" name="filter" class="btn btn-gradient-primary me-2">Search
                                    </button>
                                    <a class="btn btn-primary me-2" href="assignBatch.php">Reset</a>

                                </div>
                            </div>
                        </form>

                        <hr />

                        <form id="myBatch" action="" method="post">
                            <div class="row my-4">
                                <div class="col-5">
                                    <label for="exampleInputUsername1">Select Batch to assign selected ids</label>
                                    <select class="custom-select" id="batch_code" required>
                                        <?php foreach ($batch_list as $course): ?>
                                        <option value="<?php echo $course['batch_code'];?>">
                                            <?php echo $course['batch_code'];?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-5 my-3">
                                    <button class="my-3 btn btn-primary" type="submit">Assign batch</button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="myTable">
                                    <thead class="thead-dark table-dark">
                                        <tr>
                                            <th class="py-1 justify-content-center">
                                                <div class="d-flex p-3">
                                                    <input type="checkbox" id="select-all">
                                                </div>
                                            </th>
                                            <th> Student Name </th>
                                            <th> Email </th>
                                            <th> Phone </th>
                                            <th> Course </th>
                                            <th> Admission Date</th>
                                            <th> Batch</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($student_data as $student_row): ?>
                                        <tr>
                                            <td class="py-1 justify-content-center ">
                                                <div class="d-flex px-4 py-3">
                                                    <input type="checkbox" class="select-checkbox" name="selected_ids[]"
                                                        value="<?php echo $student_row['id']; ?>">
                                                </div>
                                            </td>
                                            <td class="align-items-center"><?php echo $student_row['f_name']; ?></td>
                                            <td class="align-items-center"><?php echo $student_row['email']; ?></td>
                                            <td class="align-items-center"><?php echo $student_row['phone']; ?></td>
                                            <td class="align-items-center"><?php echo $student_row['course_name'];?>
                                            </td>
                                            <td class="align-items-center"><?php echo $student_row['created_at']; ?>
                                            </td>
                                            <td class="align-items-center"><?php
                                            if($student_row['batch_id'] === '0' ){
                                                echo 'No Batch Assign Yet';
                                            }else{
                                                echo $student_row['batch_id'];
                                            }
                                            ?></td>
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


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>


<script>
var checkedIds = [];

document.getElementById("select-all").addEventListener("change", function() {
    var checkboxes = document.getElementsByClassName("select-checkbox");
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = this.checked;
        if (this.checked && !checkedIds.includes(checkboxes[i].value)) {
            checkedIds.push(checkboxes[i].value);
        } else if (!this.checked && checkedIds.includes(checkboxes[i].value)) {
            checkedIds.splice(checkedIds.indexOf(checkboxes[i].value), 1);
        }
    }
    console.log("Checked IDs:", checkedIds);
});

var checkboxes = document.getElementsByClassName("select-checkbox");
for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener("change", function() {
        if (this.checked && !checkedIds.includes(this.value)) {
            checkedIds.push(this.value);
        } else if (!this.checked && checkedIds.includes(this.value)) {
            checkedIds.splice(checkedIds.indexOf(this.value), 1);
        }
        document.getElementById("select-all").checked = checkedIds.length === checkboxes.length;
        // console.log("Checked IDs:", checkedIds);
    });
}


document.getElementById("myBatch").addEventListener("submit", function(event) {
    event.preventDefault();

    var selectElement = document.getElementById("batch_code").value;



    var checkedIdsString = JSON.stringify(checkedIds);



    var formData = {
        batch_id: selectElement,
        checkedIdsString: checkedIdsString
    };

    $.ajax({
        url: 'AjaxMutation.php?assignBatch=1',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response) {
                console.log("data", response);
                alert("batch is update to student");
                location.reload();
            } else {
                console.log("hello", response);
            }
            console.log("dataaa");
        },
    });

});
</script>




</html>