<?php
include_once 'components/header.php';
include_once 'components/navbar.php';
include_once 'components/sidebar.php';
include_once '../classes/category.class.php';
$category = new Category();
$caregories = $category->getAllCategories();
?>

<!-- add modal -->
<div id="addModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addForm" action="backend/category/add_category.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Name</label>
                        <input type="text" name="category_name" class="form-control" required>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label class="label-input" for="category_image" id="basic-addon1" style="width: 150px;">Image</label>
                        <input type="file" accept=".jpg, .jpeg, .png" class="form-control" id="category_image" aria-label="category" name="category_image" aria-describedby="basic-addon1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" style="background-color:grey; color:white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn" style="background-color:black; color:white">Add Category</button>
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
                <h5 class="modal-title">Update category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateForm" action="backend/category/update_category.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="update_id" name="category_id" value="">
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Name</label>
                        <input type="text" id="update_name" name="category_name" value="" class="form-control" required>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label for="update_image">Current Image</label>
                        <img id="update_image" src="images/default.png" alt="" style="width: 120px;">
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label for="">New Image</label>
                        <input type="hidden" id="current_image" name="old_image" value="">
                        <input type="file" accept=".jpg, .jpeg, .png" class="form-control" id="categories_image" aria-label="category" name="new_image" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" style="background-color:grey; color:white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn" style="background-color:black; color:white">Update Category</button>
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
                            Categories
                            <button type="button" class="btn float-end" style="background-color:black; color:white" data-bs-toggle="modal" data-bs-target="#addModal">Add Category</button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myDataTable" class="table table-bordered ">
                                <thead>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($caregories as $category) {
                                    ?>
                                        <tr>
                                            <td><?= $category['category_id'] ?></td>
                                            <td><?= $category['category_name'] ?></td>
                                            <td><img src="images/<?= $category['category_image'] ?>" alt="" style="width: 150px;"></td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-start gap-2">
                                                    <button type="button" data-category='<?= json_encode($category) ?>' data-bs-toggle="modal" data-bs-target="#updateModal" class="btn-edit myBtn-icon">
                                                        <i class="fa-solid fa-pen-to-square text-success "></i>
                                                    </button>
                                                    <form class='deleteForm d-inline' action="backend/category/delete_category.php" method="POST" style="margin-top: 15px;">
                                                        <input type="hidden" name="category_id" value="<?= $category['category_id']; ?>">
                                                        <input type="hidden" name="category_image" value="<?= $category['category_image']; ?>">
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
            var category = $(this).data('category');
            $('#update_id').val(category.category_id);
            $('#update_name').val(category.category_name);
            $('#current_image').val(category.category_image);
            $('#update_image').attr('src', 'images/' + category.category_image);
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