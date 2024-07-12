<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>


    <?php include 'comman_include.php'; ?>

    <?php include 'style1.php'; ?>


    <link type="text/css"
        href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css"
        rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: #b66dff !important;
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
                    </span>Insert Staff
                </h3>
            </div>


            <div class="row mt-2">
                <div class="card p-1 ">
                    <div class="card-body p-2">

                        <h4 class="card-title">Student Batch Assign</h4>
                        <div class="row">
                            <div class="col-5">
                                <select id="selectedBatches" name="selected_batches[]" class="js-example-basic-multiple"
                                    multiple="multiple" style="width:100%">
                                    <?php foreach ($batch_list as $course): ?>
                                    <option value="<?php echo $course['batch_code']; ?>">
                                        <?php echo $course['batch_code']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-5">
                                <button class="btn btn-primary p-2" type="submit" onclick="assginBatch();">Assign
                                    batch</button>
                            </div>
                        </div>

                        <div id="myBatch" class="table-responsive mt-3">
                            <table class="table table-striped table-bordered pt-3" id="myTable">
                                <thead class="thead-dark table-dark">
                                    <tr>
                                        <th></th>
                                        <th>Staff Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Batches</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
        foreach ($staffList as $student_row): ?>
                                    <tr>
                                        <td><?php echo $student_row['id']; ?></td>
                                        <td><?php echo $student_row['f_name']; ?></td>
                                        <td><?php echo $student_row['email']; ?></td>
                                        <td><?php echo $student_row['phone']; ?></td>
                                        <td><?php echo $student_row['addres']; ?></td>
                                        <td>
                                            <?php 

    $batch_ids = explode(',', $student_row['batches']);

  
    if (!empty($student_row['batches'])) {
        foreach ($batch_ids as $batch_id): ?>

                                            <button class="btn btn-danger p-1 delete-batch"
                                                data-id="<?php echo $student_row['id']; ?>"
                                                data-batch-id="<?php echo $batch_id; ?>">
                                                <?php echo $batch_id; ?> <i class="fa fa-trash"></i>
                                            </button>

                                            <?php endforeach;
    } else {
        echo "No batches assigned";
    }
    ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>





                    </div>
                </div>
            </div>



        </div>
    </div>
    <?php endif ?>

    <?php include 'script2.php'; ?>
    <!-- End custom js for this page -->
</body>


<script src="assets/vendors/select2/select2.min.js"></script>
<script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>

<script src="assets/js/typeahead.js"></script>
<script src="assets/js/select2.js"></script>


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
        },
        'order': [
            [0, 'asc']
        ],
        'paging': true,
    });
});
</script>


<script>
function assginBatch(status) {

    var selectedValues = [];
    var selectedOptions = document.getElementById('selectedBatches').selectedOptions;
    for (var i = 0; i < selectedOptions.length; i++) {
        selectedValues.push(selectedOptions[i].value);
    }

    var selected_row_data = table.column(0).checkboxes.selected();
    var selectedData = [];

    $.each(selected_row_data, function(key, rowIndex) {
        var rawData = table.row(key).data();
        var dataObject = {
            userId: rowIndex,
            selectValue: selectedValues
        };
        selectedData.push(dataObject);
    });

    objectData = JSON.stringify(selectedData);

    var formData = {
        checkedIdsAndBatchCode: objectData
    };

    $.ajax({
        url: 'AjaxMutation.php?staffBatch=1',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            console.log(response)
            if (response) {
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



$(document).on('click', '.delete-batch', function() {
    var userId = $(this).data('id');
    var batchId = $(this).data('batch-id');

    var formData = {
        userId: userId,
        batchId: batchId
    };
    console.log(formData);

    $.ajax({
        url: 'AjaxMutation.php?staffDelete=1',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                location.reload();
            } else {
                console.log("Error:", response.message);
            }
        },
        error: function(xhr, status, error) {
            console.log("Error:", error);
        }
    });
});
</script>



</html>