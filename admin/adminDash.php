<?php if ($user['login_type'] == 1) : ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Admin Dashboard
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


        <div class="row">

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Staff
                        </h4>
                        <h2 class="mb-5"><?php echo $totalStaffCount; ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Student
                        </h4>
                        <h2 class="mb-5"><?php echo $totalStudentCount; ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Courses
                        </h4>
                        <h2 class="mb-5">3</h2>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body p-3">
                        <h4 class="card-title">All Student List</h4>
                        <hr>
                        <h5 class="card-title">Filter</h5>

                        <form method="post">
                            <div class="form-row my-4 p-2">

                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <label for="inputZip">Start Date</label>
                                        <input type="date" class="form-control p-2 my-2"
                                            value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>"
                                            name="start_date" placeholder="Start Date">
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <label for="inputZip">End Date</label>
                                        <input type="date" class="form-control p-2 w-100 my-2"
                                            value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>"
                                            name="end_date" placeholder="End Date">
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <label for="exampleInputUsername1">Course</label>
                                        <select class="form-select w-100 my-2" name="course_id" required>
                                            <option
                                                <?php echo !isset($_POST['course_id']) || $_POST['course_id'] == '0' ? 'selected' : ''; ?>
                                                value="0">Select Course</option>
                                            <?php foreach ($courses as $course): ?>
                                            <option
                                                <?php echo isset($_POST['course_id']) && $_POST['course_id'] == $course['id'] ? 'selected' : ''; ?>
                                                value="<?php echo $course['id'];?>">
                                                <?php echo $course['course_name'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <label for="exampleInputUsername1">Batch</label>
                                        <select class="form-select w-100 my-2" name="batch_id" id="batch_id" required>
                                            <option value="NA"
                                                <?php echo (!isset($_POST['batch_id']) || $_POST['batch_id'] == 'NA') ? 'selected' : ''; ?>>
                                                Select Batch
                                            </option>
                                            <option value="0"
                                                <?php echo (isset($_POST['batch_id']) && $_POST['batch_id'] == '0') ? 'selected' : ''; ?>>
                                                No Batch Assign
                                            </option>
                                            <?php foreach ($batch_list as $batch): ?>
                                            <option value="<?php echo $batch['batch_code']; ?>"
                                                <?php echo (isset($_POST['batch_id']) && $_POST['batch_id'] == $batch['batch_code']) ? 'selected' : ''; ?>>
                                                <?php echo $batch['batch_code']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <label for="exampleInputUsername1">Fee Status</label>
                                        <select class="form-select w-100 my-2" name="fee_status" id="fee_status"
                                            required>
                                            <option value="fee" select>
                                                Select Mode
                                            </option>
                                            <option value="1"
                                                <?php echo (isset($_POST['fee_status']) && $_POST['fee_status'] == '1') ? 'selected' : ''; ?>>
                                                Paid
                                            </option>
                                            <option value="0"
                                                <?php echo (isset($_POST['fee_status']) && $_POST['fee_status'] == '0') ? 'selected' : ''; ?>>
                                                Unpaid
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-12 my-3 d-flex">
                                        <button type="submit" name="filter"
                                            class="btn btn-gradient-primary me-2 py-1">Search
                                        </button>
                                        <a class="btn btn-primary me-2" href="index.php">Reset</a>

                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered py-3" id="allStudent">
                                <thead class="thead-dark table-dark">
                                    <tr>
                                        <th> Student Name </th>
                                        <th> Email </th>
                                        <th> Phone </th>
                                        <th> Course </th>
                                        <th> Student Batch </th>
                                        <th> Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($student_data as $student_row): ?>
                                    <tr>



                                        <td class="m-0 py-1 px-3">
                                            <?php echo $student_row['f_name']; ?>
                                        </td>
                                        <td class="m-0 py-1 px-3">
                                            <?php echo $student_row['email']; ?>
                                        </td>
                                        <td class="m-0 py-1 px-3">
                                            <?php echo $student_row['phone']; ?>
                                        </td>
                                        <td class="m-0 py-1 px-3">
                                            <?php echo $student_row['plan_name']; ?>
                                        </td>
                                        <td>
                                            <?php
            if ($student_row['batch_id'] === '0') {
                echo 'NA';
            } else {
                echo $student_row['batch_id'];
            }
            ?>
                                        </td>
                                        <td class="m-0 py-1 px-3">
                                            <?php
    if ($student_row['payment'] === '1') {
        echo "<span class='badge badge-success w-100'>Done</span>";
    } else {
        echo "<span class='badge badge-danger w-100'>Pending</span>";
    }
    ?>
                                            <div class='mt-1'>
                                                <a class='text-white text-decoration-none'
                                                    href='viewStudent.php?view_id=<?php echo $student_row['id']; ?>&course_id=2'>
                                                    <button class='badge badge-info w-100'>View</button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>




    </div>


</div>
<?php endif ?>