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
                        <i class="fa fa-file-text"></i>
                    </span> Student Assignement
                </h3>
            </div>

            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body p-3">
                            <h4 class="card-title">Student List</h4>
                            <div class="table-responsive p-2 ">
                                <table class="table pt-3" id="myTable">
                                    <thead class="thead-dark table-dark">
                                        <tr>
                                            <th> S.No. </th>
                                            <th> Student Name </th>
                                            <th> Assing. Name</th>
                                            <th> Assing. Description </th>
                                            <th> Assing. PDF </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($u_AllAssignments as $assign): ?>
                                        <tr>
                                            <td class="py-1 justify-content-center">
                                                <?php echo $count; ?>
                                            </td>
                                            <td>
                                                <?php echo $assign['f_name'].$assign['l_name'] ; ?>
                                            </td>
                                            <td>
                                                <?php echo $assign['name']; ?>
                                            </td>
                                            <td>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"
                                                    disabled><?php echo $assign['textarea']; ?></textarea>
                                            </td>
                                            <td>
                                                <a
                                                    href="./uploads/<?php echo $assign['pdf_file']; ?>"><?php echo $assign['pdf_file']; ?></a>

                                            </td>
                                        </tr>
                                        <?php 
                                     $count++;
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
</body>

<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script type="text/javascript"
    src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
<script>
$(document).ready(function() {
    table = $('#myTable').DataTable();
});
</script>

</html>