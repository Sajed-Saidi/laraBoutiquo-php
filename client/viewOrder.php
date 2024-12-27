<?php
include_once 'components/header.php';
include_once '../middleware/login.php';
include_once 'components/navbar.php';

include_once '../classes/order.class.php';
include_once '../classes/product.class.php';

$order = new Order();
if ($_GET) {
    $orders = $order->getOrderById($_GET['order_id']);
    $orders = $orders[0];
    $orderItems = $order->getOrderItems($_GET['order_id']);
?>

    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt mt-5">
                        <h1>View Order</h1>
                    </div>
                </div>
                <div class="col-lg-7"></div>
            </div>
        </div>
    </div>

    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="content-body">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header ">
                                    <h4 class="mb-0  ">Order Information:</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row mb-2">
                                                <div class="col-4"><strong class="float-end">User ID:</strong></div>
                                                <div class="col-8"><?= $orders['user_id'] ?></div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4"><strong class="float-end">Country:</strong></div>
                                                <div class="col-8"><?= $orders['country'] ?></div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4"><strong class="float-end">Phone:</strong></div>
                                                <div class="col-8"><?= $orders['phone'] ?></div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4"><strong class="float-end">Address:</strong></div>
                                                <div class="col-8"><?= $orders['address'] ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Order Items:</h4>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="myDataTable" class="table table-bordered ">
                                            <thead>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total Price</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($orderItems as $orderItem) {
                                                    $product = new Product();
                                                    $products = $product->getProductById($orderItem['product_id']);
                                                    foreach ($products as $product) {
                                                ?>
                                                        <tr>
                                                            <td><?= $product['product_name']; ?></td>
                                                            <td>$<?= $product['product_price']; ?></td>
                                                            <td><?= $orderItem['quantity']; ?></td>
                                                            <td>$<?= $orderItem['total_price']; ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    include_once "components/footer.php";
    include_once "components/scripts.php";
}
?>

</body>

</html>