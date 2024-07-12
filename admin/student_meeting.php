<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>


    <?php include 'style1.php'; ?>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
</head>

<body>


    <?php include 'navbar.php'; ?>
    <?php include 'sidebar.php'; ?>


    <div class="main-panel">
        <div class="content-wrapper">

            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="fa fa-video-camera"></i>
                    </span> Student Batch & Meeting
                </h3>
            </div>

            <div class="container">
                <div class="main-body">

                    <div class="row gutters-sm">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <?php if($user['batch_id'] !== '0'): ?>
                                    <div class="row my-2">
                                        <div class="col">
                                            <h6 class="mb-0">Batch Start</h6>
                                        </div>
                                        <div class="col">
                                            <?php echo $user['start_date']; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="mb-0">Batch End</h6>
                                        </div>
                                        <div class="col">
                                            <?php echo $user['end_date']; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h6 class="mb-0">Class Timing</h6>
                                        </div>
                                        <div class="col-6">
                                            <?php echo $user['start_batch']." - ".$user['end_batch']; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h6 class="mb-0">Batch Day</h6>
                                        </div>
                                        <div class="col-6">
                                            <?php echo $user['batch_day']?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h6 class="mb-0">Course</h6>
                                        </div>
                                        <div class="col-6">
                                            <?php echo $user['course_name']?>
                                        </div>
                                    </div>
                                    <hr>
                                    <?php else: ?>
                                    <p>No batch assigned yet. please contact to teacher</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gutters-sm">

                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body">

                                    <div class="row my-2">
                                        <div class="col-12">
                                            <div class="row my-3">
                                                <div class="col">
                                                    <h6 class="mb-0">Meeting Link</h6>
                                                </div>
                                                <div class="col">
                                                    <a class="btn btn-success py-2 px-3"
                                                        href="<?php echo $user['meeting_url']; ?>" target="_blank">
                                                        <i class="fa fa-video-camera"></i>
                                                        Start
                                                        Meeting</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row my-3">
                                                <div class="col">
                                                    <h6 class="mb-0">Meeting ID:</h6>
                                                </div>
                                                <div class="col">
                                                    <?php echo $user['meeting_meeting_id']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row my-3">
                                                <div class="col">
                                                    <h6 class="mb-0">Meeting Password:</h6>
                                                </div>
                                                <div class="col">
                                                    <?php echo $user['meeting_password']; ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>





                    </div>
                </div>


            </div>
        </div>




        <?php include 'script2.php'; ?>
        <!-- End custom js for this page -->
</body>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>


<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>

</html>