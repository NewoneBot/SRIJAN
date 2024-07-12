<?php

include 'comman_include.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Application Report</title>

    <?php include 'style.php'; ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'nav.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->

                <div class="container my-5">
                    <div class="row">
                        <div class="col-md-12 mx-auto p-2 rounded" style="background:#fff;">

                            <h2 class="card-title mb-4 text-center p-2"
                                style="color:#fff;font-size:1.2em;font-weight:bold;background:maroon;">

                                Application Report</h2>
                            <table class="table table-bordered text-center" style="background:#fff;color:#000;">
                                <colgroup>
                                    <col style="width: 30%;">
                                    <col style="width: 70%;">
                                </colgroup>
                                <tr>
                                    <th>Student Name:</th>
                                    <td><?php echo $user['f_name']." ".$user['l_name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Father's Husband's Name:</th>
                                    <td><?php echo $user['fth_name'] ?></td>
                                </tr>
                                <tr>
                                    <th>Father's Husband's Occupation:</th>
                                    <td><?php echo $user['fth_occuption'] ?></td>
                                </tr>
                                <tr>
                                    <th>Qualification:</th>
                                    <td><?php echo isset($user['qualification'])?$user['qualification']:""; ?></td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td><?php echo isset($user['phone'])?$user['phone']:""; ?></td>
                                </tr>
                                <tr>
                                    <th>Address:</th>
                                    <td><?php echo isset($user['addres'])?$user['addres']:""; ?></td>
                                </tr>
                                <tr>
                                    <th>State:</th>
                                    <td><?php echo isset($user['state'])?$user['state']:""; ?></td>
                                </tr>
                                <tr>
                                    <th>Pincode:</th>
                                    <td><?php echo isset($user['pincode'])?$user['pincode']:""; ?></td>
                                </tr>
                                <tr>
                                    <th>Gender:</th>
                                    <td><?php echo isset($user['gender'])?$user['gender']:""; ?></td>
                                </tr>
                                <tr>
                                    <th>Photo:</th>
                                    <td><img class="img-thumbnail" src="<?php echo $user['photo'];?>" width="50%">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Certificate:</th>
                                    <td><img class="img-thumbnail" src="<?php echo $user['certificate'];?>" width="50%">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Aadhar:</th>
                                    <td><img class="img-thumbnail" src="<?php echo $user['adhar']; ?>" width="50%">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Signature:</th>
                                    <td><img class="img-thumbnail" src="<?php echo $user['sign'];?>" width="50%">
                                    </td>
                                </tr>
                            </table>
                            <div class="d-flex justify-content-center">
                                <div class="text-center mx-4">
                                    <button type="submit" class="btn btn-danger" name="submit"><a
                                            href="registration.php" class="text-white">Edit</a></button>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success" name="submit"><a href="plan_page.php"
                                            class="text-white">Submit</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include 'script.php'; ?>
</body>

</html>