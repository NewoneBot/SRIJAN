<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>


    <?php include 'style1.php'; ?>



</head>

<body>


    <?php include 'navbar.php'; ?>
    <?php include 'sidebar.php'; ?>

    <?php include 'adminDash.php'; ?>
    <?php include 'staffDash.php'; ?>
    <?php include 'studentDash.php'; ?>





    <?php include 'script2.php'; ?>
    <!-- End custom js for this page -->
</body>


<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    table = $('#newStudent').DataTable({});
    table = $('#allStudent').DataTable({});
});
</script>

</html>