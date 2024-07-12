<?php
include 'config.php';
include 'session_store.php';
include 'query.php';
include 'style.php';
include 'nav.php';
?>

<style>
:root {
    --white: #fff;
    --color: #05c46b;
    --background: #21293E;
}

.pricingTable {
    background: var(--background);
    font-family: 'Poppins', sans-serif;
    text-align: center;
    border-radius: 30px 30px;
    padding: 30px 0;
    margin: 0 10px;
    position: relative;
    z-index: 1;
}

.pricingTable:before {
    content: "";
    background: var(--white);
    width: calc(100% - 30px);
    height: 400px;
    border-radius: 20px 20px;
    transform: translateX(-50%);
    position: absolute;
    top: 150px;
    left: 50%;
    box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.9);
    z-index: -1;
}

.pricingTable .pricingTable-header {
    color: var(--white);
    margin: 0 auto 25px;
}

.pricingTable .title {
    font-size: 35px;
    font-weight: 500;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin: 0;
}

.pricingTable .price-value {
    color: var(--white);
    background-color: var(--color);
    font-size: 12px;
    font-weight: 400;
    text-transform: capitalize;
    height: 130px;
    width: 130px;
    padding: 40px 15px;
    margin: 0 auto 25px;
    border-radius: 50%;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
}

.pricingTable .price-value span {
    display: block;
}

.pricingTable .price-value span.amount {
    font-size: 35px;
    font-weight: 500;
    line-height: 35px;
}

.pricingTable .pricing-content {
    padding: 0;
    margin: 0 0 50px;
    list-style: none;
    display: inline-block;
}

.pricingTable .pricing-content li {
    color: #666;
    font-size: 13px;
    font-weight: 700;
    line-height: 35px;
    text-transform: uppercase;
    text-align: left;
    padding: 0 28px 0 0;
    margin: 0 0 7px;
    position: relative;
}

.pricingTable .pricing-content li:before {
    content: "\f00c";
    font-family: "Font Awesome 5 free";
    color: #018d24;
    font-weight: 900;
    position: absolute;
    top: 1px;
    right: 8px;
}

.pricingTable .pricing-content li.disable:before {
    content: "\f00d";
    color: #EF0F41;
}

.pricingTable .pricingTable-signup a {
    color: white;
    background: var(--color);
    font-size: 18px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 2px;
    padding: 6px 10px;
    border-radius: 30px;
    display: inline-block;
    position: relative;
    transition: all 0.3s ease-in-out;
}


.pricingTable .pricingTable-signup a:hover:before {
    transform: translateX(-50%) translateY(-50%) scale(1);
}

.pricingTable.pink {
    --color: #ee184e;
}

.pricingTable.blue {
    --color: #01B4C8;
}

@media only screen and (max-width: 990px) {
    .pricingTable {
        margin: 0 0 40px;
    }
}
</style>
<div class="demo  mb-5 py-5">
    <div class="container">
        <div class="row">


            <?php foreach ($courses as $course): ?>
            <div class="col-12 col-md-4">
                <div class="pricingTable">
                    <div class="pricingTable-header">
                        <h3 class="title"><?php echo $course['plan_name']; ?></h3>
                    </div>
                    <div class="price-value">
                        <span class="amount flex">Rs.<?php echo $course['price']; ?></span>
                        <span class="duration"><?php echo $course['billing_period']; ?></span>
                    </div>
                    <ul class="pricing-content">
                        <li><?php echo $course['billing_period']; ?></li>
                        <li><?php echo $course['class_timing']; ?></li>
                        <li><?php echo $course['traning_hours']; ?></li>
                        <li>Teacher’s Feedback</li>
                        <li>Daily Homework and Classwork</li>
                        <li>4k Video Quality</li>
                        <li>Certificate of Completion</li>
                    </ul>
                    <div class="pricingTable-signup">
                        <a href="payment.php?course_id=<?php echo $course['id'];?>">Payment</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>



        </div>
    </div>
</div>

<?php
include 'script.php';
?>