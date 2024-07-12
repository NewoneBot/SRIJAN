<?php include 'comman_include.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admission Form</title>

    <?php include 'style.php'; ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php  include_once 'nav.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->

                <div class="container mb-5">
                    <form action="" method="POST" enctype="multipart/form-data" id="admissionForm">
                        <div class="row py-3">
                            <div class="col-md-12 p-3 rounded shadow-lg" style="background:#fff;">
                                <h3 class="text-center p-2"
                                    style="color:#fff;font-size:1.2em;font-weight:bold;background:#041a5b;">
                                    Admission Form
                                </h3>
                                <h4 style="color:#000;font-size:12px;font-weight:bold;">Personal Details</h4>
                                <div class="mb-2">
                                    <input type="text" id="fh" name="f_name" class="form-control form-control-sm"
                                        value="<?php echo $f_name ?>" placeholder="Enter first name" required>
                                </div>
                                <div class="mb-2">
                                    <input type="text" id="fh" name="l_name" class="form-control form-control-sm"
                                        value="<?php echo $user['l_name'] ?>" placeholder="Enter last name" required>
                                </div>
                                <div class="mb-2">
                                    <input type="text" id="fh" name="email" class="form-control form-control-sm"
                                        placeholder="Enter email" value="<?php echo $email ?>" required>
                                </div>
                                <div class="mb-2">
                                    <input type="text" id="fh" name="father_name" class="form-control form-control-sm"
                                        placeholder="Enter Father's Name" value="<?php echo $user['fth_name'] ?>"
                                        required>
                                </div>
                                <div class="mb-2">
                                    <input type="text" id="fho" name="fho" class="form-control form-control-sm"
                                        placeholder="Enter Father's Occupation"
                                        value="<?php echo $user['fth_occuption'] ?>" required>
                                </div>

                                <div class="mb-2">
                                    <input type="text" id="phone" name="phone" class="form-control form-control-sm"
                                        placeholder="Enter Phone Number" value="<?php echo $user['phone'] ?>" required>
                                </div>

                                <h4 style="color:#000;font-size:12px;font-weight:bold;" class="mt-3">Gender</h4>
                                <div class="d-flex justify-content-start">
                                    <div class="btn-group">
                                        <label for="maleRadio" class="mr-3" style="color:#000;">
                                            <input type="radio" name="gender" id="maleRadio" autocomplete="off"
                                                value="male" required
                                                <?php if ($user['gender'] === 'male') echo 'checked'; ?>> Male
                                        </label>
                                        <label for="femaleRadio" class="mr-3" style="color:#000;">
                                            <input type="radio" name="gender" id="femaleRadio" autocomplete="off"
                                                value="female" required
                                                <?php if ($user['gender'] === 'female') echo 'checked'; ?>> Female
                                        </label>
                                        <label for="transRadio" style="color:#000;">
                                            <input type="radio" name="gender" id="transRadio" autocomplete="off"
                                                value="transgender" required
                                                <?php if ($user['gender'] === 'transgender') echo 'checked'; ?>>
                                            Transgender
                                        </label>
                                    </div>
                                </div>

                                <h4 style="color:#000;font-size:12px;font-weight:bold;" class="mt-3">Address</h4>
                                <div class="mb-2">
                                    <input type="text" id="city" name="city" class="form-control form-control-sm"
                                        placeholder="Enter address" value="<?php echo $user['addres'] ?>" required>
                                </div>
                                <div class="mb-2">
                                    <input type="text" id="state" name="state" class="form-control form-control-sm"
                                        placeholder="Enter State" value="<?php echo $user['state'] ?>" required>
                                </div>
                                <div class="mb-2">
                                    <input type="text" id="pincode" name="pincode" class="form-control form-control-sm"
                                        placeholder="Enter Pincode" value="<?php echo $user['pincode'] ?>" required>
                                </div>

                                <h4 style="color:#000;font-size:12px;font-weight:bold;" class="mt-3">Educational Details
                                </h4>
                                <div class="mb-2">
                                    <select class="form-control form-control-sm" id="qualification" name="qualification"
                                        required>
                                        <option value="">Select Qualification</option>
                                        <option value="10th"
                                            <?php if ($user['qualification'] === '10th') echo 'selected'; ?>>
                                            10th</option>
                                        <option value="12th"
                                            <?php if ($user['qualification'] === '12th') echo 'selected'; ?>>
                                            12th</option>
                                        <option value="Graduation"
                                            <?php if ($user['qualification'] === 'Graduation') echo 'selected'; ?>>
                                            Graduation
                                        </option>
                                        <option value="Post Graduation"
                                            <?php if ($user['qualification'] === 'Post Graduation') echo 'selected'; ?>>
                                            Post
                                            Graduation</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="w-100" for="photo"
                                                style="color:#000;font-size:12px;font-weight:bold;">Passport Size
                                                Photo:</label>
                                            <div class="d-flex flex-wrap">
                                                <input type="file" class="form-control-file w-50" id="photo"
                                                    name="photo" required
                                                    onchange="previewImage(event, 'photoPreview')">
                                                <img class="img-thumbnail w-auto" id="photoPreview" src="<?php 
                                                    $currentPhotoUrl  = $user['photo'];
                                                    echo isset($currentPhotoUrl) ? $currentPhotoUrl : '#'; ?>"
                                                    alt="Passport Size Photo"
                                                    style="display: <?php echo isset($currentPhotoUrl) ? 'block' : 'none'; ?>; width: 100px; height: 100px; margin-top: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="w-100" for="certificate"
                                                style="color:#000;font-size:12px;font-weight:bold;">Qualification
                                                Certificate:</label>
                                            <div class="d-flex flex-wrap">
                                                <input type="file" class="form-control-file w-50" id="certificate"
                                                    name="certificate" required
                                                    onchange="previewImage(event, 'certificatePreview')">
                                                <img class="img-thumbnail w-auto" id="certificatePreview"
                                                    src="<?php
                                                    $currentCertificateUrl  = $user['certificate'];
                                                    echo isset($currentCertificateUrl) ? $currentCertificateUrl : '#'; ?>" alt="Qualification Certificate"
                                                    style="display: <?php echo isset($currentCertificateUrl) ? 'block' : 'none'; ?>; width: 100px; height: 100px; margin-top: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="w-100" for="adhar"
                                                style="color:#000;font-size:12px;font-weight:bold;">Aadhar:</label>
                                            <div class="d-flex flex-wrap">
                                                <input type="file" class="form-control-file w-50" id="adhar"
                                                    name="adhar" required
                                                    onchange="previewImage(event, 'adharPreview')">
                                                <img class="img-thumbnail w-auto" id="adharPreview" src="<?php 
                                                    $currentAdharUrl  = $user['adhar'];
                                                    echo isset($currentAdharUrl) ? $currentAdharUrl : '#'; ?>"
                                                    alt="Aadhar"
                                                    style="display: <?php echo isset($currentAdharUrl) ? 'block' : 'none'; ?>; width: 100px; height: 100px; margin-top: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="w-100" for="sign"
                                                style="color:#000;font-size:12px;font-weight:bold;">Signature:</label>
                                            <div class="d-flex flex-wrap">
                                                <input type="file" class="form-control-file w-50" id="sign" name="sign"
                                                    required onchange="previewImage(event, 'signPreview')">
                                                <img class="img-thumbnail w-auto" id="signPreview" src="<?php
                                                     $currentSignUrl  = $user['sign'];
                                                     echo isset($currentSignUrl) ? $currentSignUrl : '#'; ?>"
                                                    alt="Signature"
                                                    style="display: <?php echo isset($currentSignUrl) ? 'block' : 'none'; ?>; width: 100px; height: 100px; margin-top: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-danger" name="register">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>


        </div>
        <!-- End of Main Content -->



    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include 'script.php'; ?>
    <script>
    function previewImage(event, previewId) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById(previewId);
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>

</body>

</html>