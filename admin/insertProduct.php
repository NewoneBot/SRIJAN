<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>


    <?php include 'comman_include.php'; ?>

    <?php include 'style1.php'; ?>


    <style>
    .limited-text {
        width: auto;
        overflow: hidden;
        white-space: normal;
        word-wrap: break-word;
        /* Ensures long words break to fit the width */
    }
    </style>


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
                    </span> <?php echo isset($product['name']) ? 'Edit Product' : 'Insert Product'; ?>
                </h3>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body p-2 mt-3">
                        <h4 class="card-title">
                            <?php echo isset($product['name']) ? 'Edit Product' : 'Insert Product'; ?>
                        </h4>
                        <form method="post" enctype="multipart/form-data" class="forms-sample">
                            <div class="row p-2">
                                <div class="col-md-6 p-2">
                                    <div class="form-group">
                                        <label for="p_name">Product Name</label>
                                        <input type="text" class="form-control" id="p_name" placeholder="Product Name"
                                            name="p_name" required
                                            value="<?php echo isset($product['name']) ? htmlspecialchars($product['name']) : ''; ?>">
                                        <input type="hidden" class="form-control" id="p_id" placeholder="Product Name"
                                            name="product_id" required value="<?php echo isset($product['id'])?>">
                                    </div>
                                </div>
                                <div class="col-md-6 p-2">
                                    <div class="form-group">
                                        <label for="p_price">Product Price</label>
                                        <input type="number" class="form-control" id="p_price"
                                            placeholder="Product Price" name="p_price" required
                                            value="<?php echo isset($product['price']) ? htmlspecialchars($product['price']) : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12 p-2">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Course</label>
                                        <select class="form-control form-select" name="course_id" required>
                                            <option value="" selected>Select Course</option>
                                            <?php foreach ($courses as $course): ?>
                                            <option value="<?php echo $course['id']; ?>"
                                                <?php echo isset($product['category']) && $course['id'] == $product['category'] ? 'selected' : ''; ?>>
                                                <?php echo $course['course_name'];?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 p-2">
                                    <div class="form-group">
                                        <label for="desc">Product Description</label>
                                        <textarea id="desc" class="form-control" name="desc"
                                            placeholder="Product Description"
                                            rows="4"><?php echo isset($product['description']) ? htmlspecialchars($product['description']) : ''; ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6 p-2">
                                    <div class="form-group">
                                        <label>File upload</label>
                                        <input type="file" value="" name="img" class="file-upload-default"
                                            accept="image/*" id="imgInp">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info"
                                                placeholder="<?php echo isset($product['p_img']) ? htmlspecialchars(basename($product['p_img'])) : 'Upload Image'; ?>"
                                                readonly>
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-gradient-primary py-3"
                                                    type="button">Upload</button>
                                            </span>
                                        </div>
                                        <?php if (isset($product['p_img']) && !empty($product['p_img'])): ?>
                                        <img id="blah" class="m-3 img-thumbnail"
                                            src="uploads/<?php echo htmlspecialchars($product['p_img']); ?>"
                                            alt="Product Image" style="height:100px; width:100px; display:block;">
                                        <?php else: ?>
                                        <img id="blah" class="m-3 img-thumbnail" src="#" alt="Preview Image"
                                            style="display:none; height:100px; width:100px;">
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-12">


                                    <button type="submit"
                                        name="<?php echo isset($product['id']) ? 'product_update' : 'product_insert'; ?>"
                                        class="btn btn-gradient-primary">
                                        <?php echo isset($product['id']) ? 'Update' : 'Submit'; ?>
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="card p-1">
                    <div class="card-body p-2">
                        <h4 class="card-title py-2">Product List</h4>
                        <div class="table-responsive">
                            <table class="table" id="">
                                <thead class="thead-dark table-dark">
                                    <tr>
                                        <th> S.No. </th>
                                        <th> Product image</th>
                                        <th> Product ID</th>
                                        <th> Product Name</th>
                                        <th> Product Price</th>
                                        <th> Product Course</th>
                                        <th> Product Desc.</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $count = 1;
                                        foreach ($product_list as $list): ?>
                                    <tr>
                                        <td class="py-1 align-middle">
                                            <?php echo $count; ?>
                                        </td>
                                        <td>
                                            <img id="blah" class="img-fluid img-thumbnailimg-thumbnail"
                                                src="uploads/<?php echo $list['p_img']; ?>" alt="your image"
                                                style="height:100px; width:100px; border-radius: 0% !important;" />
                                        </td>
                                        <td>
                                            <?php echo $list['product_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $list['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $list['price']; ?>
                                        </td>
                                        <td>
                                            <?php echo $list['category']; ?>
                                        </td>
                                        <td>
                                            <div id="text-container" class="limited-text">
                                                <?php echo $list['description']; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <form action="insertProduct.php" method="GET" style="display: inline;">
                                                <input type="hidden" name="product_id"
                                                    value="<?php echo $list['id'];?>">
                                                <button type="submit" class="btn btn-success p-2">Edit
                                                </button>
                                            </form>

                                            <form action="insertProduct.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="product_id"
                                                    value="<?php echo $list['id'];?>">
                                                <button type="submit" name="product_delete"
                                                    class="btn btn-danger p-2">Delete</button>
                                            </form>
                                        </td>
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





        <?php endif ?>




        <?php include 'script2.php'; ?>
        <!-- End custom js for this page -->
</body>

<?php


  

?>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css">



<script src="assets/js/file-upload.js"></script>

<script>

</script>


<script>
document.getElementById('imgInp').onchange = function(evt) {
    const [file] = this.files;
    if (file) {
        document.getElementById('blah').src = URL.createObjectURL(file);
        document.getElementById('blah').style.display = 'block';
    }
}
</script>


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

</html>