<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>


    <?php include 'comman_include.php'; ?>



    <link type="text/css"
        href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css"
        rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <?php include 'style1.php'; ?>



</head>

<body>


    <?php include 'navbar.php'; ?>
    <?php include 'sidebar.php'; ?>


    <?php if ($user['login_type'] == 1) : ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span>Insert Staff
                </h3>
            </div>

            <div class="row mt-3">
                <div class="card">
                    <div class="card-body p-2 mt-3">
                        <form method="post" enctype="multipart/form-data" class="forms-sample">
                            <div class="row p-2">

                                <div class="col-md-6 p-2">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" placeholder="First name" name="f_name"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6 p-2">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" placeholder="Last Name" name="l_name"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6 p-2">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" placeholder="Email" name="email"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6 p-2">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control" placeholder="password" name="password"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6 p-2">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" placeholder="phone" name="phone"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6 p-2">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" placeholder="address" name="address"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6 p-2">
                                    <button type="submit" name="staff_creation"
                                        class="btn btn-gradient-primary me-2">Submit
                                    </button>
                                </div>


                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="card p-1">
                    <div class="card-body p-2">
                        <h4 class="card-title">Staff List</h4>

                        <form id="myBatch" action="" method="post">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered pt-3" id="myTable">
                                    <thead class="thead-dark table-dark">
                                        <tr>
                                            <th>S.no.</th>
                                            <th> Staff Name</th>
                                            <th> Email </th>
                                            <th> Password </th>
                                            <th> Phone </th>
                                            <th> Address </th>
                                            <th> Action </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $count = 1;
                                        foreach ($staffList as $student_row): ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $student_row['f_name']; ?></td>
                                            <td><?php echo $student_row['email']; ?></td>
                                            <td><?php echo $student_row['password']; ?></td>
                                            <td><?php echo $student_row['phone']; ?></td>
                                            <td><?php echo $student_row['addres']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-danger w-100 p-1 delete_staff"
                                                    data-id="<?php echo $student_row['id'] ?>">Delete</button>
                                            </td>
                                        </tr>
                                        <?php 
                                    $count++;
                                    endforeach;
                                     ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>


                    </div>
                </div>
            </div>





        </div>
    </div>

    <?php endif ?>

    <?php include 'script2.php'; ?>
    <!-- End custom js for this page -->
</body>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css">

<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script type="text/javascript"
    src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>

<script>
$(document).ready(function() {
    table = $('#myTable').DataTable();
});
</script>


<script>
$('.delete_staff').click(function() {
    var id = $(this).attr('data-id');

    if (confirm("Are you sure to delete this staff?")) {
        delete_staff(id);
    } else {
        console.log("Deletion canceled");
    }
});

function delete_staff(id) {
    console.log("hello");
    $.ajax({
        url: 'ajax.php?action=delete_staff',
        method: 'POST',
        data: {
            id: id
        },
        success: function(resp) {
            if (resp == 1) {
                location.reload();
            } else {
                console.log("error")
            }
        },
        error: function(xhr, status, error) {
            alert_toast("Failed to delete data: " + error, 'error');
        }
    });
}
</script>



</html>