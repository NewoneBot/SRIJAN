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

<style>
.limited-text {
    width: auto;
    overflow: hidden;
    white-space: normal;
    word-wrap: break-word;
}

.star-icon {
    color: gold;
    font-size: 2rem;
}
</style>

<body>


    <?php include 'navbar.php'; ?>
    <?php include 'sidebar.php'; ?>


    <div class="main-panel">
        <div class="content-wrapper">

            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="fa fa-shopping-cart"></i>
                    </span> Metrial
                </h3>
            </div>

            <div class="container">
                <div class="row">
                    <div class="card">
                        <div class="row">
                            <?php 
        foreach ($courses_list as $courses_listing) {
            if ($courses_listing['id'] == $_GET['product_id']) {
        ?>
                            <div class="col-12 col-md-6 p-3">
                                <img src="img/<?php echo $courses_listing['img']; ?>" class="w-100 p-3 rounded-5"
                                    alt="">
                            </div>
                            <div class="col-md-6 col-12 p-3 mt-3">
                                <h2><?php echo $courses_listing['course_name']; ?></h2>
                                <div>
                                    <i class="mdi mdi-star star-icon"></i>
                                    <i class="mdi mdi-star star-icon"></i>
                                    <i class="mdi mdi-star star-icon"></i>
                                    <i class="mdi mdi-star star-icon"></i>
                                    <i class="mdi mdi-star star-icon"></i>
                                </div>
                                <div class="pt-3">
                                    <?php 
                $total_price = 0; 
                foreach ($product_list as $product) { 
                    if ($product['category'] == $_GET['product_id']) {        
                        $total_price += $product['price']; 
                ?>
                                    <div class="d-flex justify-content-between col-4 py-1">
                                        <strong><i class="fa fa-check text-success"></i>
                                            <?php echo $product['name']; ?></strong>
                                        <strong><?php echo $product['price']; ?></strong>
                                    </div>
                                    <?php 
                    }
                } 
                ?>
                                    <div class="d-flex justify-content-start">
                                        <h3 class="m-3">Price</h3>
                                        <h3 class="m-3">₹<?php echo $total_price; ?></h3>
                                    </div>

                                    <form method="GET" action="checkout.php">
                                        <div class="d-flex">
                                            <input type="hidden" name="product_id"
                                                value="<?php echo $courses_listing['id']; ?>">
                                            <button type="submit" class="btn btn-primary btn-icon w-50 text-white">
                                                Check Out
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <?php 
            }
        } 
        ?>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="card p-1">
                        <div class="card-body p-2">
                            <h4 class="card-title py-2">Package Item</h4>
                            <div class="table-responsive">
                                <table class="table" id="">
                                    <thead class="thead-dark table-dark">
                                        <tr>
                                            <th> Product image</th>
                                            <th> Product Name</th>
                                            <th> Product Price</th>
                                            <th> Product Desc.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                     
                                        foreach ($product_list as $list):
                                        if($list['category'] == $_GET['product_id']){
                                        
                                        ?>
                                        <tr>
                                            <td>
                                                <img id="blah" class="img-fluid img-thumbnailimg-thumbnail"
                                                    src="uploads/<?php echo $list['p_img']; ?>" alt="your image"
                                                    style="height:100px; width:100px; border-radius: 0% !important;" />
                                            </td>
                                            <td>
                                                <?php echo $list['name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $list['price']; ?>
                                            </td>

                                            <td>
                                                <div id="text-container" class="limited-text">
                                                    <?php echo $list['description']; ?>
                                                </div>
                                            </td>

                                        </tr>
                                        <?php 
                                   
                                    }
                                    endforeach; 
                                    
                                    ?>
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
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>


<script>
function initiatePayment(amount, amount_type) {
    var form = document.getElementById('paymentForm');
    var name = "<?php echo $user['f_name']?>";
    var email = "<?php echo $user['email']; ?>";
    var phone = "<?php echo $user['phone']; ?>";




    // var options = {
    //     "key": "rzp_test_qjT3c6fPCFzTB1",
    //     "amount": amount * 100,
    //     "currency": "INR",
    //     "name": "Srijan Mithila",
    //     "description": "Payment for your service",
    //     "image": "assets/images/logo.jpg",
    //     "prefill": {
    //         "name": name,
    //         "email": email,
    //         "contact": phone
    //     },
    //     "notes": {
    //         "address": "Your Company Address"
    //     },
    //     "theme": {
    //         "color": "#3399cc"
    //     },
    //     "handler": function(res) {
    //         console.log("Payment successful", res.razorpay_payment_id);
    //         /*
    //         $.ajax({
    //             url: 'process_payment.php',
    //             type: 'POST',
    //             data: {
    //                 name: name,
    //                 email: email,
    //                 phone: phone,
    //                 payment_id: res.razorpay_payment_id,
    //                 course_id: form.elements['product_id'].value,
    //                 amount: amount,
    //                 payment_type: amount_type
    //             },
    //             success: function(response) {
    //                 window.location.href = 'index.php';
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error('Error sending payment data:', error);
    //             }
    //         });
    //         */
    //     }
    // };

    // var rzp = new Razorpay(options);
    // rzp.open();

    // rzp.on('payment.error', function(response) {
    //     console.log("Payment failed", response.error);
    //     alert('Payment failed: ' + response.error.description);
    // });
}
</script>

</html>