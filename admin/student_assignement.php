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

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Upload Assignement</h4>
                        <form method="post" enctype="multipart/form-data" class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputName1">Assignment Name</label>
                                <input type="text" class="form-control" id="exampleInputName1" name="assignment_name"
                                    placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Assignment Description</label>
                                <textarea class="form-control" id="exampleTextarea1" name="assignment_description"
                                    rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" class="custom-file-input" id="validatedCustomFile" name="pdf_file"
                                    accept=".pdf" required>
                                <label class="custom-file-label" for="validatedCustomFile">Choose PDF file...</label>
                                <div class="invalid-feedback">Please select a PDF file.</div>
                            </div>
                            <button type="submit" name="assignment"
                                class="btn btn-gradient-primary me-2">Submit</button>
                            <button type="button" class="btn btn-light">Cancel</button>
                        </form>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body p-3">
                            <h4 class="card-title">Student List</h4>
                            <div class="table-responsive p-2">
                                <table class="table" id="myTable">
                                    <thead class="thead-dark table-dark">
                                        <tr>
                                            <th> S.No. </th>
                                            <th> Assing. Name</th>
                                            <th> Assing. Description </th>
                                            <th> Assing. PDF </th>
                                            <th> Assing. Delete </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($u_assign as $assign): ?>
                                        <tr>
                                            <td class="py-1 justify-content-center">
                                                <?php echo $count; ?>
                                                <!-- Assuming 'id' is a column in your 'assignments' table -->
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
                                            <form action="" method="POST">
                                                <td>
                                                    <input type="hidden" name="assignment_id"
                                                        value="<?php echo $assign['id']; ?>">
                                                    <button type="submit" class="badge badge-danger w-100"
                                                        name="assignmentDelete">Delete</button>
                                                </td>
                                            </form>
                                        </tr>
                                        <?php 
                                     $count++;
                                    endforeach; ?>
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


</html>