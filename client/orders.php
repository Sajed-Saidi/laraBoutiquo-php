<?php
include_once 'components/header.php';
include_once '../middleware/login.php';
include_once 'components/navbar.php';
include_once '../classes/order.class.php';
$order = new Order();
$orders = $order->getAllOrder();

?>
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt mt-5">
                    <h1>Orders</h1>
                </div>
            </div>
            <div class="col-lg-7"></div>
        </div>
    </div>
</div>

<div class="untree_co-section before-footer-section">
    <div class="container">
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
                                <td><?= $order['order_status']; ?></td>
                                <td>
                                    $<?= $order['total_price'] ?> </td>
                                <td>
                                    <a href="viewOrder.php?order_id=<?= $order['order_id']; ?>" class="btn" style="background-color:black; color:white">
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

<?php
include_once "components/footer.php";
include_once "components/scripts.php";
?>

</body>

</html>