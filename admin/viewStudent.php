<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>


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
                    </span> Student Details
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <span></span>Overview <i
                                class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="container">
                <div class="main-body">
                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="<?php echo $viewUser['photo'];?>" alt="Admin" class="rounded-circle"
                                            width="150" height="150">
                                        <div class="mt-3">
                                            <h4>
                                                <?php echo $viewUser['f_name']." ". $viewUser['l_name'] ?>
                                            </h4>
                                            <p class="text-secondary mb-1">
                                                <?php echo $viewUser['email']; ?>
                                            </p>
                                            <p class="text-muted font-size-sm">
                                                <?php echo $viewUser['phone']; ?>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 d-flex align-items-stretch">
                            <div class="card mb-3 w-100 ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Full Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo $viewUser['f_name']." ". $viewUser['l_name'] ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo $viewUser['email']; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phone</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo $viewUser['phone']; ?>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Course Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo $viewUser['course_name']; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Address</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo $viewUser['addres']; ?>
                                        </div>
                                    </div>


                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <!-- batch details --------------------------------------------------------------------- -->



            <div class="container-fluid">
                <h3 class="page-title my-3">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span> Batch Details
                </h3>
                <div class="main-body">
                    <div class="row gutters-sm p-0">
                        <div class="col-md-12">
                            <div class="card p-0 m-0">
                                <div class="card-body p-4">
                                    <?php if($viewUser['batch_id'] !== '0'): ?>
                                    <div class="row my-2">
                                        <div class="col">
                                            <h6 class="mb-0">Batch Start</h6>
                                        </div>
                                        <div class="col">
                                            <?php echo $viewUser['start_date']; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="mb-0">Batch End</h6>
                                        </div>
                                        <div class="col">
                                            <?php echo $viewUser['end_date']; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h6 class="mb-0">Class Timing</h6>
                                        </div>
                                        <div class="col-6">
                                            <?php echo $viewUser['start_batch']." - ".$viewUser['end_batch']; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h6 class="mb-0">Batch Day</h6>
                                        </div>
                                        <div class="col-6">
                                            <?php echo $viewUser['batch_day']?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h6 class="mb-0">Course</h6>
                                        </div>
                                        <div class="col-6">
                                            <?php echo $viewUser['course_name']?>
                                        </div>
                                    </div>
                                    <hr>
                                    <?php else: ?>
                                    <p>Please Assgin The Batch </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- feee details ----------------------------------------------------------------------- -->



            <div class="container-fluid">
                <h3 class="page-title my-3">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span> Current Plan Fee Details
                </h3>
                <div class="main-body">
                    <div class="row gutters-sm p-0">
                        <div class="col-md-12 col-12">
                            <div class="card p-0">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="card w-100">
                                                    <div class="card-header">
                                                        <?php if ($viewUser['payment_method'] == 1): ?>
                                                        Installment Amount List
                                                        <?php else: ?>
                                                        Full Payment Details
                                                        <?php endif; ?>
                                                    </div>

                                                    <?php
            // Assuming $dbh is your PDO database connection
            $course_id = isset($_GET['course_id']) ? $_GET['course_id'] : null;
            $viewUser_id = $viewUser['id'];

            // Fetch transactions for the specific user and course_id
            $strtransaction = $dbh->prepare("
                SELECT 
                    *
                FROM 
                    users u 
                LEFT JOIN 
                    transactions t ON u.id = t.user_id
                WHERE 
                    u.id = ?
                    AND t.course_id = ?
            ");
            $strtransaction->execute([$viewUser_id, $course_id]);
            $viewUserTransaction = $strtransaction->fetchAll(PDO::FETCH_ASSOC);

            $total_amount = $viewUser['price']; // Total amount for all installments
            $installment_count = 3; // Number of installments

            // Calculate the amount per installment as a floating point
            $amount_per_installment = $total_amount / $installment_count;

            // Round the first two installments down to two decimal places
            $first_installment = round($amount_per_installment, 2);
            $second_installment = round($amount_per_installment, 2);

            // Calculate the third installment to ensure the total is correct
            $third_installment = round($total_amount - ($first_installment + $second_installment), 2);

            // Initialize total paid amount
            $total_paid = 0;

            // Calculate total paid amount across all installments
            foreach ($viewUserTransaction as $transaction) {
                $total_paid += $transaction['amount'];
            }

            // Define the installment amounts
            $installments = [
                $first_installment,
                $second_installment,
                $third_installment
            ];
            ?>

                                                    <?php if ($viewUser['payment_method'] == 1): ?>
                                                    <table class="table table-striped table-bordered">
                                                        <thead class="thead-dark table-dark">
                                                            <tr>
                                                                <th>Installment</th>
                                                                <th>Paid</th>
                                                                <th>Remaining</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                        // Display installment details
                        $count = 1;
                        $next_payment_amount = 0;
                        $next_payment_set = false; // Flag to set the next payment amount only once

                        for ($i = 0; $i < $installment_count; $i++):
                            // Fetch installment details or set default values
                            if (isset($viewUserTransaction[$i])) {
                                $amount_paid = $viewUserTransaction[$i]['amount'];
                            } else {
                                $amount_paid = 0; // Default to 0 if installment data is not available
                            }

                            // Calculate remaining amount
                            $amount_remaining = $installments[$i] - $amount_paid;

                            // Set the next payment amount if it has not been set yet
                            if (!$next_payment_set && $amount_remaining > 0) {
                                $next_payment_amount = $amount_remaining;
                                $next_payment_set = true;
                            }
                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?php if ($amount_paid > 0): ?>
                                                                    <i class="fa fa-check text-success "
                                                                        aria-hidden="true"></i>
                                                                    <?php else: ?>
                                                                    <i class="fa fa-times text-danger"
                                                                        aria-hidden="true"></i>
                                                                    <?php endif; ?>
                                                                    <strong class="px-3">Installment
                                                                        <?php echo $count; ?>
                                                                    </strong>
                                                                </td>
                                                                <td>
                                                                    <?php echo number_format($amount_paid, 2); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo number_format(max($amount_remaining, 0), 2); ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                            $count++;
                        endfor;
                        ?>
                                                        </tbody>
                                                    </table>
                                                    <?php else: ?>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Full Payment Details</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Total Amount</td>
                                                                <td>
                                                                    <?php echo number_format($total_amount, 2); ?>
                                                                </td>
                                                            </tr>
                                                            <?php foreach ($viewUserTransaction as $transaction): ?>
                                                            <tr>
                                                                <td>Payment Amount</td>
                                                                <td>
                                                                    <?php echo number_format($transaction['amount'], 2); ?>
                                                                </td>
                                                            </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                    <?php endif; ?>
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



            <div class="container mt-3">
                <h3 class="page-title ">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span> Student Total Transaction
                </h3>

                <div class="row p-4">
                    <div class="card p-2">
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
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


<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    table = $('#newStudent').DataTable({});
    table = $('#allStudent').DataTable({});
});
</script>

</html>