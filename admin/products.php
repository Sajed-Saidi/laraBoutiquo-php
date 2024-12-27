<?php
include_once 'components/header.php';
include_once 'components/navbar.php';
include_once 'components/sidebar.php';
include_once '../classes/product.class.php';
include_once '../classes/category.class.php';

$product = new Product();
$products = $product->getAllProducts();

$category = new Category();
$categoris = $category->getAllCategories();
?>
<!-- add modal -->
<div id="addModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addForm" action="backend/product/add_product.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Name</label>
                        <input type="text" name="product_name" class="form-control" required>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label class="label-input" for="product_image" id="basic-addon1" style="width: 150px;">Image</label>
                        <input type="file" accept=".jpg, .jpeg, .png" class="form-control" id="product_image" aria-label="product" name="product_image" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Description</label>
                        <input type="text" name="product_description" class="form-control" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Price</label>
                        <input type="text" name="product_price" class="form-control" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Quantity</label>
                        <input type="text" name="product_quantity" class="form-control" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Select Category</label>
                        <select class="form-select" id="category_id" name="category_id" aria-label="Default select example">
                            <?php foreach ($categoris as $category) {
                            ?>
                                <option value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" style="background-color:grey; color:white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn" style="background-color:black; color:white">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Update Modal -->
<div id="updateModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateForm" action="backend/product/update_product.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="update_id" name="product_id" value="">
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Name</label>
                        <input type="text" id="update_name" name="product_name" value="" class="form-control" required>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label for="update_image">Current Image</label>
                        <img id="update_image" src="images/default.png" alt="" style="width: 120px;">
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label for="">New Image</label>
                        <input type="hidden" id="current_image" name="old_image" value="">
                        <input type="file" accept=".jpg, .jpeg, .png" class="form-control" id="categories_image" aria-label="product" name="new_image" aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Description</label>
                        <input type="text" id="update_description" name="product_description" value="" class="form-control" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Price</label>
                        <input type="text" id="update_price" name="product_price" value="" class="form-control" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Quantity</label>
                        <input type="text" id="update_quantity" name="product_quantity" value="" class="form-control" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Select Category</label>
                        <select class="form-select" id="updateCategory_id" name="updateCategory_id" aria-label="Default select example">
                            <?php foreach ($categoris as $category) {
                            ?>
                                <option value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" style="background-color:grey; color:white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn" style="background-color:black; color:white">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="content-body">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Products
                            <button type="button" class="btn float-end" style="background-color:black; color:white" data-bs-toggle="modal" data-bs-target="#addModal">Add Product</button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myDataTable" class="table table-bordered ">
                                <thead>
                                    <th>ID</th>
                                    <th>product</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>category</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($products as $product) {
                                    ?>
                                        <tr>
                                            <td><?= $product['product_id'] ?></td>
                                            <td><?= $product['product_name'] ?></td>
                                            <td><img src="images/<?= $product['product_image'] ?>" alt="" style="width: 150px;"></td>
                                            <td><?= $product['product_description'] ?></td>
                                            <td><?= $product['product_price'] ?></td>
                                            <td><?= $product['product_quantity'] ?></td>
                                            <td><?= $product['category_name'] ?></td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-start gap-2">
                                                    <button type="button" data-product='<?= json_encode($product) ?>' data-bs-toggle="modal" data-bs-target="#updateModal" class="btn-edit myBtn-icon">
                                                        <i class="fa-solid fa-pen-to-square text-success "></i>
                                                    </button>
                                                    <form class='deleteForm d-inline' action="backend/product/delete_product.php" method="POST" style="margin-top: 15px;">
                                                        <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                                                        <input type="hidden" name="product_image" value="<?= $product['product_image']; ?>">
                                                        <button type="submit" class="myBtn-icon">
                                                            <i class="fa-solid fa-trash text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'components/footer.php';
include_once 'components/scripts.php';
?>
<script>
    $(document).ready(function() {
        $(document).on('click', '.btn-edit', function(e) {
            var product = $(this).data('product');
            $('#update_id').val(product.product_id);
            $('#update_name').val(product.product_name);
            $('#current_image').val(product.product_image);
            $('#update_image').attr('src', 'images/' + product.product_image);
            $('#update_description').val(product.product_description);
            $('#update_price').val(product.product_price);
            $('#update_quantity').val(product.product_quantity);
            $('#updateCategory_id').val(product.category_id);

        });
        $(document).on('submit', '#addForm', function(e) {
            sendFormAJAX(e);
        });

        $(document).on('submit', '#updateForm', function(e) {
            sendFormAJAX(e);

        });

        $(document).on('submit', '.deleteForm', function(e) {
            sendDeleteAJAX(e);
        });
    });
</script>