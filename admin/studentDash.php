<?php if ($user['login_type'] == 2) : ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Student Dashboard
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
                                    <img src="<?php echo $user['photo'];?>" alt="Admin" class="rounded-circle"
                                        width="150" height="150">
                                    <div class="mt-3">
                                        <h4><?php echo $user['f_name']." ". $user['l_name'] ?></h4>
                                        <p class="text-secondary mb-1"><?php echo $user['email']; ?></p>
                                        <p class="text-muted font-size-sm"><?php echo $user['phone']; ?></p>
                                        <div class="col-sm-12">
                                            <a class="btn btn-info " target="__blank"
                                                href="editProfile.php?user_id='<?php echo $user['id'] ?>'">Edit</a>
                                        </div>
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
                                        <?php echo $user['f_name']." ". $user['l_name'] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $user['email']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $user['phone']; ?>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Course Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $user['course_name']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $user['addres']; ?>
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




<?php endif ?>