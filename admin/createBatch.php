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

            <div class="row">
                <div class="card">
                    <div class="card-body p-2 mt-3">
                        <h4 class="card-title">Create Batch</h4>
                        <form method="post" enctype="multipart/form-data" class="forms-sample">
                            <div class="row p-2">

                                <div class="col-md-6 p-2">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Batch Code</label>
                                        <input type="text" class="form-control" id="exampleInputUsername1"
                                            placeholder="batch Code" name="batch_code" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Batch Start Time</label>
                                        <input type="text" id="start-timepicker" class="form-control timepicker-input"
                                            name="start_time" value="" size="10" autocomplete="off"
                                            placeholder="Batch Start Time" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Batch End Time</label>
                                        <input type="text" id="end-timepicker" class="form-control timepicker-input"
                                            name="end_time" value="" size="10" autocomplete="off"
                                            placeholder="Batch End Time" required />
                                    </div>
                                </div>
                                <div class="col-md-6 p-2">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Course</label>
                                        <select class="custom-select" name="course_id" required>
                                            <option selected>Select Course</option>
                                            <?php foreach ($courses as $course): ?>
                                            <option value="<?php echo $course['id'];?>">
                                                <?php echo $course['course_name'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Batch Start Date</label>
                                        <input type="date" id="" class="form-control " name="start_date" value=""
                                            size="10" autocomplete="off" placeholder="Batch Start Time" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Batch End Date</label>
                                        <input type="date" id="" class="form-control" name="end_date" value="" size="10"
                                            autocomplete="off" placeholder="Batch End Time" required />
                                    </div>

                                </div>
                                <div class="col-md-6 p-2">
                                    <button type="submit" name="batch_creation"
                                        class="btn btn-gradient-primary me-2">Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row mt-2 ">
                <div class="card p-1">
                    <div class="card-body p-2">
                        <h4 class="card-title">Batch List</h4>
                        <div class="table-responsive">
                            <table class="table" id="">
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
                                        <th> Action </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $count = 1;
                                        foreach ($batch_list as $assign): ?>
                                    <tr>
                                        <td class="py-1 justify-content-center">
                                            <?php echo $count; ?>
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
                                        <td>
                                            <button type="button" class="btn btn-danger w-100 p-1 delete_batch"
                                                data-id="<?php echo $assign['batch_code'] ?>">Delete</button>
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
            </div>



        </div>





        <?php endif ?>




        <?php include 'script2.php'; ?>
        <!-- End custom js for this page -->
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load Day.js plugins
    ['custom'].forEach(function(format) {
        const plugin = 'dayjs_plugin_customFormat';
        if (plugin in window) {
            dayjs.extend(window[plugin]);
        }
    });

    // Initialize timepicker for both start and end time inputs
    jQuery('.timepicker-input').timepicker();

    // Get necessary elements and values
    const $startPicker = jQuery('#start-timepicker');
    const $endPicker = jQuery('#end-timepicker');
    const defaultFormat = $startPicker.timepicker('format');

    // Event listener for changes in options
    jQuery('.options-control').on('change', function() {
        // Handle changes in options if needed

        // Update attributes and options for timepicker inputs
        let options = {};
        jQuery.each(['format', 'minTime', 'maxTime', 'step', 'scheme'], function(index, option) {
            const value = document.getElementById(option).value;
            jQuery('.timepicker-input').timepicker(option, value);
            if (value.length > 0 && option !== 'format' && value !== defaultFormat) {
                options[option] = value;
            }
        });

        // Update visibility and content based on parameter type
        const paramtype = document.getElementById('paramtype').value;
        const togglebtn = (document.getElementById('togglebtn').selectedIndex > 0);
        jQuery('.timepicker-input-group').toggleClass('d-none', !togglebtn);
        $startPicker.toggleClass('d-none', togglebtn);
        $endPicker.toggleClass('d-none', togglebtn);
        jQuery('#timepicker-indent').toggleClass('d-none', !togglebtn);
        document.getElementById('timepicker-attribs').textContent = (paramtype === 'HTML') ? JSON
            .stringify(options) : '';
    });

    // Event listener for format dropdown menu
    const $format = jQuery('#format').val(defaultFormat).prop('readOnly', false);
    jQuery('#format-dropdown-menu').find('button').on('click', function() {
        $format.val(this.textContent).trigger('change');
    });

    // Event listener for reset buttons
    jQuery('.reset-btn').on('click', function() {
        jQuery('#' + this.id.substring(0, this.id.length - 10)).val('').trigger('change');
        this.disabled = true;
    });
});
</script>


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>


<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>



<script>
$('.delete_batch').click(function() {
    var id = $(this).attr('data-id');

    if (confirm("Are you sure to delete the Batch?")) {
        delete_batch(id);
    } else {
        console.log("Deletion canceled");
    }
});

function delete_batch(id) {
    console.log("hello");
    $.ajax({
        url: 'ajax.php?action=delete_batch',
        method: 'POST',
        data: {
            id: id
        },
        success: function(resp) {
            if (resp == 1) {
                location.reload();
            } else {
                console.log("error")
            }
        },
        error: function(xhr, status, error) {
            alert_toast("Failed to delete data: " + error, 'error');
        }
    });
}
</script>



</html>