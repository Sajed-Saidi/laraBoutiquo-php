<?php
include_once 'components/header.php';
include_once 'components/navbar.php';
include_once 'components/sidebar.php';
include_once '../classes/user.class.php';
$user = new User();
$users = $user->getAllUsers();
?>
<!-- add modal -->
<div id="addModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addForm" action="backend/user/add_user.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Name</label>
                        <input type="text" name="user_name" class="form-control" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Role</label>
                        <select class="form-select" id="role" name="role" aria-label="Default select example">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" style="background-color:grey; color:white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn" style="background-color:black; color:white">Add User</button>
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
                <h5 class="modal-title">Update user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateForm" action="backend/user/update_user.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="update_id" name="user_id" value="">
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Name</label>
                        <input type="text" id="update_name" name="user_name" value="" class="form-control" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Email</label>
                        <input type="email" id="update_email" name="email" value="" class="form-control" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Role</label>
                        <select class="form-select" id="update_role" name="role" aria-label="Default select example">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
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
<!-- Update Pass Modal -->
<div id="updatePassModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updatePassForm" action="backend/user/update_password.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="user_id" name="update_pass_id" value="">
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Old Password</label>
                        <input type="password" name="old_password" class="form-control" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">New Password</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="" class="input-group-text">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" style="background-color:grey; color:white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn" style="background-color:black; color:white">Update Password</button>
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
                            Users
                            <button type="button" class="btn float-end" style="background-color:black; color:white" data-bs-toggle="modal" data-bs-target="#addModal">Add User</button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myDataTable" class="table table-bordered ">
                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($users as $user) {
                                    ?>
                                        <tr>
                                            <td><?= $user['user_id'] ?></td>
                                            <td><?= $user['user_name'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td><?= $user['create_at'] ?></td>
                                            <td><?= $user['role'] ?></td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-start gap-2">
                                                    <button type="button" data-user='<?= json_encode($user) ?>' data-bs-toggle="modal" data-bs-target="#updateModal" class="btn-edit myBtn-icon">
                                                        <i class="fa-solid fa-pen-to-square text-success "></i>
                                                    </button>
                                                    <form class='deleteForm d-inline' action="backend/user/delete_user.php" method="POST" style="margin-top: 15px;">
                                                        <input type="hidden" name="user_id" value="<?= $user['user_id']; ?>">
                                                        <button type="submit" class="myBtn-icon">
                                                            <i class="fa-solid fa-trash text-danger"></i>
                                                        </button>
                                                    </form>
                                                    <button type="button" data-user='<?= json_encode($user) ?>' data-bs-toggle="modal" data-bs-target="#updatePassModal" class="btn-edit myBtn-icon">
                                                        <i class="fa-solid fa-lock"></i>
                                                    </button>

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
            var user = $(this).data('user');
            $('#update_id').val(user.user_id);
            $('#update_name').val(user.user_name);
            $('#update_email').val(user.email);
            $('#update_role').val(user.role);
            $('#user_id').val(user.user_id);
        });
        $(document).on('submit', '#addForm', function(e) {
            sendFormAJAX(e);
        });

        $(document).on('submit', '#updateForm', function(e) {
            sendFormAJAX(e);
        });

        $(document).on('submit', '#updatePassForm', function(e) {
            sendFormAJAX(e);

        });

        $(document).on('submit', '.deleteForm', function(e) {
            sendDeleteAJAX(e);
        });
    });
</script>