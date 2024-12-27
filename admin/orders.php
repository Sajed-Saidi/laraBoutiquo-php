<?php
include_once 'components/header.php';
include_once 'components/navbar.php';
include_once 'components/sidebar.php';
include_once '../classes/order.class.php';
$order = new Order();
$orders = $order->getAllOrder();
?>
<div class="content-body">
    <div class="container mt-5">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Orders</h4>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myDataTable" class="table table-bordered ">
                                <thead>
                                    <th>ID</th>
                                    <th>userID</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($orders as $order) {
                                    ?>
                                        <tr>
                                            <td><?= $order['order_id']; ?></td>
                                            <td><?= $order['user_id']; ?></td>
                                            <td><?= $order['order_date']; ?></td>
                                            <td><?= $order['total_price']; ?></td>
                                            <td>
                                                <form class="updateStatus" method="post" action="backend/order/updateOrder.php">
                                                    <div class="d-flex input-group">
                                                        <button class="btn  btn-sm m-0" style="background-color:black; color:white" type="submit">Update</button>
                                                        <input type="hidden" name="order_id" value="<?php echo $order['order_id'] ?>">
                                                        <select class="form-select flex-1" name="order_status" style="height: 33.6;" id="inputGroupSelect03" aria-label="Example select with button addon">
                                                            <option value="Pending" <?php echo $order['order_status'] == "Pending" ? "selected" : "" ?>>Pending</option>
                                                            <option value="Shipped" <?php echo $order['order_status'] == "Shipped" ? "selected" : "" ?>>Shipped</option>
                                                            <option value="Completed" <?php echo $order['order_status'] == "Completed" ? "selected" : "" ?>>Completed</option>
                                                            <option value="Cancelled" <?php echo $order['order_status'] == "Cancelled" ? "selected" : "" ?>>Cancelled</option>
                                                        </select>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="view_order.php?order_id=<?= $order['order_id']; ?>" class="btn" style="background-color:black; color:white">
                                                    View
                                                </a>
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

        $(document).on('submit', '.updateStatus', function(e) {
            sendFormAJAX(e);

        });


    });
</script>