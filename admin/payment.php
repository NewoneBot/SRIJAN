<?php
include 'config.php';
include 'session_store.php';
include 'query.php';
include 'style.php';

$name = $user['f_name'];
$email = $user['email'];
$phone= $user['phone'];


if(!isset($_GET['course_id'])){
    header("Location: plan_page.php");
}

$edit = isset($_GET['edit']);


$course_id = isset($_GET['course_id']);

// $strtransaction = $dbh->prepare("
//     SELECT 
//         *
//     FROM 
//         users u 
//     LEFT JOIN 
//         transactions t ON u.id = t.user_id
//     WHERE 
//         u.id = ?
//         AND t.course_id = ?
// ");
// $strtransaction->execute([$user_id, $course_id]);
// $userTransactionpayment = $strtransaction->fetchAll(PDO::FETCH_ASSOC);

?>



<body id="page-top" style="background-color: #eee;">
    <!-- End of Sidebar -->



    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include 'nav.php';?>

            <?php  

// Check if edit mode is enabled
if (isset($_GET['edit']) && $_GET['edit'] == 1) {
   ?>


            <section class="">
                <div class="container-fluid h-100">
                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="student_fee.php"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                                        to dashboard</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="card p-2 my-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="card w-100">
                                            <div class="card-header">
                                                <?php if ($user['payment_method'] == 1): ?>
                                                Installment Amount List
                                                <?php else: ?>
                                                Full Payment Details
                                                <?php endif; ?>

                                            </div>

                                            <?php
                    // Assuming $dbh is your PDO database connection
                    $course_id = isset($_GET['course_id']) ? $_GET['course_id'] : null;
                    $user_id = $user['id'];

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
                    $strtransaction->execute([$user_id, $course_id]);
                    $userTransaction = $strtransaction->fetchAll(PDO::FETCH_ASSOC);

                    $total_amount = $user['price']; // Total amount for all installments
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
                    foreach ($userTransaction as $transaction) {
                        $total_paid += $transaction['amount'];
                    }

                    // Define the installment amounts
                    $installments = [
                        $first_installment,
                        $second_installment,
                        $third_installment
                    ];

                    // Display installment details if payment method is 'installment'
                    if ($user['payment_method'] == 1) {
                        // Loop through each installment to determine the remaining amount
                        $count = 1;
                        $next_payment_amount = 0;
                        $next_payment_set = false; // Flag to set the next payment amount only once

                        for ($i = 0; $i < $installment_count; $i++):
                            // Fetch installment details or set default values
                            if (isset($userTransaction[$i])) {
                                $amount_paid = $userTransaction[$i]['amount'];
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

                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <div>
                                                        <?php if ($amount_paid > 0): ?>
                                                        <i class="fa fa-check text-success pr-3" aria-hidden="true"></i>
                                                        <?php else: ?>
                                                        <i class="fa fa-times text-danger pr-4" aria-hidden="true"></i>
                                                        <?php endif; ?>
                                                        <strong>Installment <?php echo $count; ?></strong>
                                                    </div>
                                                    <?php echo "Paid: " . number_format($amount_paid, 2) . ", Remaining: " . number_format(max($amount_remaining, 0), 2); ?>
                                                </li>
                                            </ul>

                                            <?php
                            $count++;
                        endfor;

                    } else { // Display full payment details
                        ?>

                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    Total Amount: <?php echo number_format($total_amount, 2); ?>
                                                </li>
                                                <?php foreach ($userTransaction as $transaction): ?>
                                                <li class="list-group-item">
                                                    Payment Amount:
                                                    <?php echo number_format($transaction['amount'], 2); ?>
                                                </li>
                                                <?php endforeach; ?>
                                            </ul>

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="card py-1 my-3">
                                <div class="card-body">
                                    <div class="">
                                        <label for="paymentMethod" class="form-label">
                                            <?php echo $user['payment_method'] == 1 ? "Installments" : "Full payment"; ?>
                                        </label>
                                    </div>
                                    <form action="">
                                        <div id="installmentDetails">
                                            <?php if ($user['payment_method'] == 1 && $next_payment_amount > 0): ?>
                                            <hr>
                                            <h1>Click to pay your next installment</h1>
                                            <hr>
                                            <button type="button" name="installment_payment"
                                                class="btn btn-info btn-block btn-lg"
                                                onclick="initiatePayment(<?php echo $next_payment_amount; ?>, '1');">
                                                <div class="d-flex justify-content-between">
                                                    <span>Rs.
                                                        <?php echo number_format($next_payment_amount, 2); ?></span>
                                                    <span>Checkout <i
                                                            class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                </div>
                                            </button>
                                            <?php elseif ($user['payment_method'] == 1 && $next_payment_amount <= 0): ?>
                                            <button type="button" class="btn btn-info btn-block btn-lg" disabled>
                                                All installments paid
                                            </button>
                                            <?php else: ?>
                                            <button type="button" class="btn btn-info btn-block btn-lg" disabled>
                                                Payment Done
                                            </button>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </section>

            <?php
            foreach ($courses as $course): 
                $course_id = $course['id'];
            endforeach;
} 

else {    
?>

            <section class="h-100 h-custom" style="background-color: #eee;">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col">
                            <div class="card">
                                <div class="card-body p-4">

                                    <div class="row">

                                        <div class="col-lg-7">
                                            <h5 class="mb-3"><a href="plan_page.php" class="text-body"><i
                                                        class="fas fa-long-arrow-alt-left me-2"></i> Change Plan</a>
                                            </h5>
                                            <hr>


                                            <?php foreach ($courses as $course): 
                                                $course_id = $course['id'];
                                                $totalAmount = $course['price']; // Total amount to be paid
        $numberOfInstallments = 3; // Number of installments

// Calculate installment amount
$installmentAmount = round($totalAmount / $numberOfInstallments, 2);
                                                
                                                
                                                ?>
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex flex-row align-items-center">
                                                            <div class="ms-3">
                                                                <h5>
                                                                    <?php echo $course['course_name']; ?>
                                                                </h5>
                                                                <p class="small mb-0">
                                                                    <?php echo $course['plan_name']; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-row align-items-center">
                                                            <div style="width: 100px;">
                                                                <h5 class="mb-0">Rs.
                                                                    <?php echo $course['price']; ?>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <div class="ms-3">
                                                            <h5>Course Details :</h5>
                                                            <div class="px-3 py-2">
                                                                <h6>
                                                                    Course :
                                                                    <?php echo $course['billing_period']; ?>
                                                                </h6>
                                                                <h6>
                                                                    Classes hours :
                                                                    <?php echo $course['traning_hours']; ?>
                                                                </h6>
                                                                <h6>
                                                                    Classes session :
                                                                    <?php echo $course['class_timing']; ?>
                                                                </h6>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>




                                        </div>
                                        <div class="col-lg-5">
                                            <div class="card bg-primary text-white rounded-3">
                                                <div class="card-body">
                                                    <!-- Payment method dropdown -->
                                                    <div class="mb-3">
                                                        <label for="paymentMethod" class="form-label">Select Payment
                                                            Method:</label>
                                                        <select class="custom-select" id="paymentMethod"
                                                            onchange="togglePaymentMethod(this)">
                                                            <option value="full_payment">Full Payment</option>
                                                            <option value="installments">Installments</option>
                                                        </select>
                                                    </div>

                                                    <!-- Full Payment details -->
                                                    <form action="" id="paymentForm" method="POST"
                                                        onsubmit="event.preventDefault(); initiatePayment(<?php echo $totalAmount?>,'0');">
                                                        <div id="fullPaymentDetails">
                                                            <hr class="my-4">
                                                            <div class="d-flex justify-content-between">
                                                                <p class="mb-2">Total</p>
                                                                <p class="mb-2"><?php echo $totalAmount?></p>
                                                            </div>
                                                            <hr class="my-4">

                                                            <button type="submit" class="btn btn-info btn-block btn-lg">
                                                                <div class="d-flex justify-content-between">
                                                                    <span><?php echo $totalAmount?></span>
                                                                    <span>Checkout <i
                                                                            class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                                </div>
                                                            </button>
                                                        </div>
                                                    </form>

                                                    <form action="">
                                                        <div id="installmentDetails" style="display: none;">
                                                            <hr class="my-4">
                                                            <?php for ($i = 1; $i <= $numberOfInstallments; $i++): ?>
                                                            <div class="d-flex justify-content-between">
                                                                <p class="mb-2"><?php echo $i; ?> Installment</p>
                                                                <p class="mb-2">Rs. <?php 
                                                                        echo $installmentAmount;
                                                                        $payinstallment = $installmentAmount;
                                                                    ?></p>
                                                            </div>
                                                            <?php endfor; ?>

                                                            <hr class="my-4">

                                                            <button type="button" type="submit"
                                                                name="installment_payment"
                                                                class="btn  btn-info btn-block btn-lg"
                                                                onclick="initiatePayment(<?php echo $payinstallment; ?>,'1');">
                                                                <div class="d-flex justify-content-between">
                                                                    <span>Rs.<?php echo $payinstallment; ?></span>
                                                                    <span>Checkout <i
                                                                            class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                                </div>
                                                            </button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>

    <?php 
        } 
    
        ?>

    <?php include 'script.php'; ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>


    <script>
    function togglePaymentMethod(selectElement) {
        var selectedValue = selectElement.value;
        if (selectedValue === "full_payment") {
            document.getElementById("fullPaymentDetails").style.display = "block";
            document.getElementById("installmentDetails").style.display = "none";
        } else if (selectedValue === "installments") {
            document.getElementById("fullPaymentDetails").style.display = "none";
            document.getElementById("installmentDetails").style.display = "block";
        }
    }
    </script>



    <script>
    function initiatePayment(amount, amount_type) {

        var form = document.getElementById('paymentForm');
        var name = "<?php echo $name; ?>";
        var email = "<?php echo $email; ?>";
        var phone = "<?php echo $phone; ?>";
        var course_id = "<?php echo $course_id; ?>";

        var amountInt = parseInt(amount, 10);

        var options = {
            "key": "rzp_test_qjT3c6fPCFzTB1",
            "amount": amountInt * 100,
            "currency": "INR",
            "name": "Srijan Mithila",
            "description": "Payment for your service",
            "image": "assets/images/logo.jpg",
            "prefill": {
                "name": name,
                "email": email,
                "contact": phone
            },
            "notes": {
                "address": "Your Company Address"
            },
            "theme": {
                "color": "#3399cc"
            },
            "handler": function(res) {

                console.log("Payment successful", res.razorpay_payment_id);

                $.ajax({
                    url: 'process_payment.php',
                    type: 'POST',
                    data: {
                        name: name,
                        email: email,
                        phone: phone,
                        payment_id: res.razorpay_payment_id,
                        course_id: course_id,
                        amount: amount,
                        payment_type: amount_type
                    },
                    success: function(response) {
                        window.location.href = 'index.php';
                    },
                    error: function(xhr, status, error) {
                        console.error('Error sending payment data:', error);
                    }
                });


            }
        };


        var rzp = new Razorpay(options);
        rzp.open();

        rzp.on('payment.error', function(response) {
            console.log("Payment failed", response.error);
            alert('Payment failed: ' + response.error.description);
        });
    }
    </script>

</body>

</html>