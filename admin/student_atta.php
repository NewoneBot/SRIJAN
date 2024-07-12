<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Student</title>
    <?php include 'style1.php'; ?>
</head>

<body>


    <?php include 'navbar.php'; ?>
    <?php include 'sidebar.php'; ?>


    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span>Student Attendance
                </h3>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mb-3">
                    <div class="bg-gradient-danger text-white">
                        <div class="card-body p-4">
                            <h4 class="font-weight-normal mb-3">Total Classes
                            </h4>
                            <h2 class="mb-5"><?php echo $user['total_classes']; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class=" bg-gradient-info  text-white">
                        <div class="card-body p-4">
                            <h4 class="font-weight-normal mb-3">Total Present
                            </h4>
                            <h2 class="mb-5"><?php echo isset($present_count) ? $present_count : 0 ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class=" bg-gradient-success text-white">
                        <div class="card-body p-4">

                            <h4 class="font-weight-normal mb-3">Total Absent
                            </h4>
                            <h2 class="mb-5"><?php echo isset($absent_count) ? $absent_count: 0  ?></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="card p-1">
                    <div class="card-body p-2">
                        <h4 class="card-title"></h4>
                        <form id="myBatch" action="" method="post">
                            <div class="table-responsive">
                                <h5>Attandance Records</h5>
                                <table class="table pt-3 table-striped table-bordered" id="myTable">
                                    <thead class="thead-dark table-dark">
                                        <tr>
                                            <th> S.no.</th>
                                            <th> Attandance Date</th>
                                            <th> Attendance Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                         $count = 1;
                                        foreach ($student_attandace_data as $student_row): ?>

                                        <tr>

                                            <td><?php echo $count; ?></td>

                                            <td class="">
                                                <?php echo date('Y-m-d', strtotime($student_row['created_at'])); ?></td>

                                            <td class="d-flex justify-content-center">
                                                <?php

    if ($student_row['status'] === 'p') {
        echo '<button type="button" class="btn btn-success w-25 p-3">Present</button>';
    } else {
        echo '<button type="button" class="btn btn-danger w-25 p-3">Absent</button>';
    }
?>

                                            </td>
                                        </tr>
                                        <?php 
                                    $count++;
                                    endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>






        </div>
    </div>




    <?php include 'script2.php'; ?>
    <!-- End custom js for this page -->
</body>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>

</html>