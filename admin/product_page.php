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
                        <i class="fa fa-shopping-cart"></i>
                    </span> Metrial
                </h3>
            </div>
            <div class="container">
                <div class="row d-flex justify-content-start">
                    <?php foreach ($courses_list as $courses_listing) { ?>
                    <div class="col-md-4 col-sm-6 p-2 d-flex align-items-stretch">
                        <div class="card p-2" style="width: 100%;">
                            <img class="card-img-top" style="width: 100%; height:13rem;"
                                src="img/<?php echo $courses_listing['img'];?>" alt="Card image cap">
                            <div class="card-body p-0 mt-2 d-flex flex-column">
                                <div class="my-2">
                                    <h5><?php echo $courses_listing['course_name']; ?></h5>
                                    <hr>
                                    <h5>Product List</h5>
                                    <ul>
                                        <?php 
                            $total_price = 0; 
                            foreach ($product_list as $product) { 
                                if ($product['category'] == $courses_listing['id']) {        
                                    $total_price += $product['price']; 
                            ?>
                                        <li>
                                            <div class="d-flex justify-content-between">
                                                <strong><?php echo $product['name']; ?></strong>
                                                <strong><?php echo $product['price']; ?></strong>
                                            </div>
                                        </li>
                                        <?php 
                                }
                            } ?>
                                    </ul>
                                </div>
                                <div class="mt-auto">
                                    <hr>
                                    <div class="d-flex justify-content-between py-2">
                                        <strong>Total</strong>
                                        <strong>Rs. <?php echo $total_price; ?></strong>
                                    </div>
                                    <form action="product_pay.php" method="GET">
                                        <div class="d-flex">
                                            <input type="hidden" name="product_id"
                                                value="<?php echo $courses_listing['id'];?>">
                                            <button type="submit" class="btn btn-dark btn-icon w-100 text-white">
                                                Choose Plan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
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