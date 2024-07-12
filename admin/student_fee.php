<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <?php include 'style1.php'; ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
</head>

<body>


    <?php include 'navbar.php'; ?>
    <?php include 'sidebar.php'; ?>


    <div class="main-panel">
        <div class="content-wrapper">

            <div class="page-header flex-wrap p-0">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="fa fa-credit-card-alt"></i>
                    </span> Student Fee
                </h3>
                <div class="d-flex flex-wrap">
                    <a href="plan_page.php" class="btn bg-gradient-info text-white  my-3 mx-2"> Buy Course</a>
                    <a href="payment.php?course_id=<?php echo $user['course_id'];?>&edit=1"
                        class="btn btn-success my-3 mx-2">Pay
                        Your
                        Fee </a>
                </div>
            </div>


            <div class="row card mb-3">
                <div class="card-body p-3">
                    Curent Plan Course: <strong><?php echo $user['course_name'];?></strong>
                </div>
            </div>


            <div class="row  mb-3">
                <div class="col-md-4 mb-3">
                    <div class="bg-gradient-danger text-white">
                        <div class="card-body p-4">
                            <h4 class="font-weight-normal mb-3">Total fee
                            </h4>
                            <h2 class="mb-5"><?php echo $user['price']; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class=" bg-gradient-info  text-white">
                        <div class="card-body p-4">
                            <h4 class="font-weight-normal mb-3">Total Paid Fee</h4>
                            <?php 
        $totalAmount = 0;
        $student_course_id = $user['course_id'];

        foreach($userTransaction as $student_row){
            if ($student_row['course_id'] == $student_course_id) {
                $totalAmount += $student_row['amount'];
            }
        }
        ?>
                            <h2 class="mb-5">
                                <?php echo $totalAmount ?>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class=" bg-gradient-success text-white">
                        <div class="card-body p-4">

                            <h4 class="font-weight-normal mb-3">Left Amount
                            </h4>
                            <h2 class="mb-5"><?php echo $user['price']-$totalAmount; ?></h2>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row mt-2">
                <div class="card p-1">
                    <div class="card-body p-2 ">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="">
                                <thead class="thead-dark table-dark">
                                    <tr>
                                        <th class="py-1 justify-content-center">
                                            <div class="d-flex p-3">
                                                S.no.
                                            </div>
                                        </th>
                                        <th>Transaction Date</th>
                                        <th>Payment Type</th>
                                        <th>Amount</th>
                                        <th>Payment ID</th>
                                        <th>Course Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
        $count = 1;
        if (!empty($userTransaction)) {
            foreach ($userTransaction as $student_row): ?>
                                    <tr>
                                        <td class="py-1 justify-content-center">
                                            <div class="d-flex p-3">
                                                <?php echo $count; ?>
                                            </div>
                                        </td>
                                        <td><?php echo date('d-m-Y', strtotime($student_row['transaction_date'])); ?>
                                        </td>
                                        <td><?php
                if ($student_row['payment_method'] == 1) {
                    echo "Installment";
                } else {
                    echo "Full Payment";
                }
                ?></td>
                                        <td><?php echo $student_row['amount']; ?></td>
                                        <td><?php echo $student_row['payment_id']; ?></td>
                                        <td><?php echo $student_row['course_name']; ?></td>
                                    </tr>
                                    <?php 
            $count++;
            endforeach; 
        } else { ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No data available</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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