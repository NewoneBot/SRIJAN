<div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">

            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>

            <?php 
if ($user['login_type'] == 1 ||  $user['login_type'] == 0) {

    if($user['login_type'] == 1){
?>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#staff" aria-expanded="false" aria-controls="auth">
                    <span class="menu-title">Staff</span>
                    <i class="menu-arrow"></i>
                    <i class="fa fa-graduation-cap menu-icon" aria-hidden="true"></i>
                </a>
                <div class="collapse" id="staff">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="insertStaff.php">Insert Staff</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="staffBatchAssgin.php">Staff List</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#student_batch" aria-expanded="false"
                    aria-controls="auth">
                    <span class="menu-title">Batch</span>
                    <i class="menu-arrow"></i>
                    <i class="fa fa-graduation-cap menu-icon" aria-hidden="true"></i>
                </a>
                <div class="collapse" id="student_batch">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="createBatch.php">Creat Batch</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="assignBatch.php">Assign Batch Student</a>
                        </li>
                    </ul>
                </div>
            </li>

            <?php } ?>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#student" aria-expanded="false"
                    aria-controls="auth">
                    <span class="menu-title">Student</span>
                    <i class="menu-arrow"></i>
                    <i class="fa fa-graduation-cap menu-icon" aria-hidden="true"></i>
                </a>
                <div class="collapse" id="student">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="student_attendance.php">Student Attendance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="student_all_assigment.php">Student Assigment</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#meeting" aria-expanded="false"
                    aria-controls="auth">
                    <span class="menu-title">Meeting Creation</span>
                    <i class="menu-arrow"></i>
                    <i class="fa fa-graduation-cap menu-icon" aria-hidden="true"></i>
                </a>
                <div class="collapse" id="meeting">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="meetingCreation.php">Create Meeting</a>
                        </li>
                    </ul>
                </div>
            </li>

            <?php  if($user['login_type'] == 1){ ?>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#product" aria-expanded="false"
                    aria-controls="auth">
                    <span class="menu-title">Our Product</span>
                    <i class="menu-arrow"></i>
                    <i class="fa fa-graduation-cap menu-icon" aria-hidden="true"></i>
                </a>
                <div class="collapse" id="product">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="insertProduct.php">Insert Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Product List</a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php } ?>
            <?php
} else {
?>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#student" aria-expanded="false"
                    aria-controls="auth">
                    <span class="menu-title">Student</span>
                    <i class="menu-arrow"></i>
                    <i class="fa fa-graduation-cap menu-icon" aria-hidden="true"></i>
                </a>
                <div class="collapse" id="student">
                    <ul class="nav flex-column sub-menu">
                        <!-- uploading  -->
                        <li class="nav-item">
                            <a class="nav-link" href="student_meeting.php">Student Batch & Metting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="student_assignement.php">Student Assigment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="student_atta.php">Student Attendas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="student_fee.php">Student Fee</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#course" aria-expanded="false" aria-controls="auth">
                    <span class="menu-title">Course Material</span>
                    <i class="menu-arrow"></i>
                    <i class="fa fa-graduation-cap menu-icon" aria-hidden="true"></i>
                </a>
                <div class="collapse" id="course">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="product_page.php">Material List</a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php
}
?>
            <!-- <hr /> -->

            <!--<li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                    <span class="menu-title">User Pages</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-lock menu-icon"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/samples/login.html"> Login </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/samples/register.html"> Register </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/samples/error-404.html"> 404 </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/samples/error-500.html"> 500 </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <span class="menu-title">Basic UI Elements</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                    <span class="menu-title">Icons</span>
                    <i class="mdi mdi-contacts menu-icon"></i>
                </a>
                <div class="collapse" id="icons">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/icons/font-awesome.html">Font Awesome</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms">
                    <span class="menu-title">Forms</span>
                    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                </a>
                <div class="collapse" id="forms">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/forms/basic_elements.html">Form Elements</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false"
                    aria-controls="charts">
                    <span class="menu-title">Charts</span>
                    <i class="mdi mdi-chart-bar menu-icon"></i>
                </a>
                <div class="collapse" id="charts">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false"
                    aria-controls="tables">
                    <span class="menu-title">Tables</span>
                    <i class="mdi mdi-table-large menu-icon"></i>
                </a>
                <div class="collapse" id="tables">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="docs/documentation.html" target="_blank">
                    <span class="menu-title">Documentation</span>
                    <i class="mdi mdi-file-document-box menu-icon"></i>
                </a>
            </li> -->

        </ul>
    </nav>