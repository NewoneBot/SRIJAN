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





    <?php if ($user['login_type'] == 2) : ?>

    <div class="main-panel">
        <div class="content-wrapper p-2">

            <div class="container p-2">
                <div class="main-body p-2">

                    <div class="row gutters-sm">


                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body p-4">
                                    <h4 class="card-title">Shipping Address</h4>
                                    <form class="forms-sample">

                                        <div class="form-group my-3">
                                            <label for="full_name">Full Name</label>
                                            <input type="text" class="form-control form-control-sm" id="full_name"
                                                placeholder="Username" name="full_name">
                                        </div>

                                        <div class="form-group my-3">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control form-control-sm" id="email"
                                                placeholder="Email" name="address">
                                        </div>

                                        <div class="form-group my-3">
                                            <label for="phone">Phone</label>
                                            <input type="number" class="form-control form-control-sm" id="phone"
                                                placeholder="Phone" name="Phone">
                                        </div>

                                        <div class="form-group my-3">
                                            <label for="address">Address</label>
                                            <textarea class="form-control" id="address" name="address" rows="4"
                                                placeholder="Address"></textarea>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <?php 
        foreach ($courses_list as $courses_listing) {
            if ($courses_listing['id'] == $_GET['product_id']) {
                $course_weight = $courses_listing['weight'];
        ?>
                                        <div class="col-12">
                                            <div class="">
                                                <div class="d-flex  justify-content-between">
                                                    <h3>Order</h3>
                                                    <h3><i class="fa fa-shopping-cart" aria-hidden="true"></i></h3>
                                                </div>
                                                <?php 
            $total_price = 0; 
            foreach ($product_list as $product) { 
                if ($product['category'] == $_GET['product_id']) {        
                    $total_price += $product['price']; 
                }
            } 
        ?>
                                                <div class="d-flex justify-content-between col-12 py-1">
                                                    <strong><i class="fa fa-check text-success"></i> Amount</strong>
                                                    <strong>₹ <?php echo $total_price ?></strong>
                                                </div>

                                                <div class="d-flex justify-content-between col-12 py-1">
                                                    <strong><i class="fa fa-check text-success"></i> Delivery</strong>
                                                    <strong id="shipping_ammount"></strong>
                                                </div>

                                                <hr>
                                                <div class="d-flex justify-content-between">
                                                    <h3>Total</h3>
                                                    <h3 id="total_price">₹<?php echo $total_price; ?></h3>
                                                </div>

                                                <form method="GET" action="checkout.php">
                                                    <div class="d-flex">
                                                        <input type="hidden" name="product_id"
                                                            value="<?php echo $courses_listing['id']; ?>">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-icon w-100 text-white">
                                                            Pay Now
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
function login(email = "webglobalnetworkcom@gmail.com", password = "Newone@123") {
    return new Promise((resolve, reject) => {
        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        var raw = JSON.stringify({
            "email": email,
            "password": password
        });

        var requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: raw,
            redirect: 'follow'
        };

        fetch("https://apiv2.shiprocket.in/v1/external/auth/login", requestOptions)
            .then(response => response.json())
            .then(result => {
                if (result.token) {
                    resolve(result.token);
                } else {
                    reject('No token found in response');
                }
            })
            .catch(error => reject(error));
    });
}

// Example data to pass with the fetch request
// const requestData = {
//     "pickup_postcode": 110018,
//     "delivery_postcode": <?php echo $user['pincode']; ?>,
//     "weight": <?php echo $course_weight; ?>,
//     "cod": 1
// };

const requestData = {
    "pickup_postcode": 110018,
    "delivery_postcode": 110059,
    "weight": 5,
    "cod": 0
};

console.log(requestData);

login().then(token => {
    console.log('Token:', token);

    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    myHeaders.append("Authorization", `Bearer ${token}`);

    // Construct URL with query parameters
    const url = new URL("https://apiv2.shiprocket.in/v1/external/courier/serviceability/");
    url.searchParams.append('pickup_postcode', requestData.pickup_postcode);
    url.searchParams.append('delivery_postcode', requestData.delivery_postcode);
    url.searchParams.append('weight', requestData.weight);
    url.searchParams.append('cod', requestData.cod);

    var requestOptions = {
        method: 'GET',
        headers: myHeaders,
        redirect: 'follow'
    };

    fetch(url, requestOptions)
        .then(response => response.json())
        .then(result => {
            console.log('Serviceability Response:', result);

            const availableCouriers = result.data.available_courier_companies;
            if (availableCouriers && availableCouriers.length > 0) {
                const deliveryCharge = availableCouriers[0]
                    .freight_charge; // Assuming `freight_charge` holds the delivery charge
                console.log('Delivery Charge:', deliveryCharge);

                document.getElementById('shipping_ammount').textContent = `₹ ${deliveryCharge}`;

                const total_price = <?php echo $total_price; ?>;
                const totalAmount = total_price + deliveryCharge;
                document.getElementById('total_price').textContent = `₹${totalAmount}`;
            } else {
                console.log('No available couriers found in the response');
            }
        })
        .catch(error => console.log('Error:', error));
}).catch(error => {
    console.log('Error:', error);
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