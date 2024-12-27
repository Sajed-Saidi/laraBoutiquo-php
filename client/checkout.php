<?php
include_once 'components/header.php';
include_once '../middleware/login.php';
require_once "../classes/cart.class.php";
require_once "../classes/product.class.php";
$totalPrice = 0;

if (isset($_SESSION['login'])) {
    $cart = new Cart();
    $cartItems = $cart->getCartById($user_id);

    if (count($cartItems) == 0) {
        header("Location:./cart.php");
        $_SESSION['message'] = "Cart is Empty!";
        exit();
    }
}
include_once 'components/navbar.php';
?>
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Checkout</h1>
                </div>
            </div>
            <div class="col-lg-7"></div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section">
    <div class="container">
        <form class='addForm d-inline' action="backend/addOrder.php" id="addForm" method="POST">
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Billing Details</h2>
                    <div class="p-3 p-lg-5 border bg-white">
                        <div class="form-group">
                            <label for="country" class="text-black">Country <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="country" name="country" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_fname" name="c_fname" required />
                            </div>
                            <div class="col-md-6">
                                <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_lname" name="c_lname" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="address" class="text-black">Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Street address" required />
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-6">
                                <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                                <input type="Email" class="form-control" id="c_email_address" name="c_email_address" required />
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="text-black">Phone <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="c_order_notes" class="text-black">Order Notes</label>
                            <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Your Order</h2>
                            <div class="p-3 p-lg-5 border bg-white">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($cartItems as $cartItem) {
                                            $product = new Product();
                                            $products = $product->getProductById($cartItem['product_id']);
                                            foreach ($products as $product) {
                                        ?>
                                                <tr>
                                                    <td>
                                                        <?= $product['product_name']; ?><strong class="mx-2">x</strong> <?= $cartItem['quantity']; ?>
                                                    </td>
                                                    <td>$<?= $cartItem['total_price']; ?></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td class="text-black font-weight-bold">
                                                <strong>Cart Subtotal</strong>
                                            </td>
                                            <td class="text-black"><?php

                                                                    foreach ($cartItems as $cartItem) {
                                                                        $totalPrice += $cartItem['total_price'];
                                                                    }
                                                                    echo '$' . number_format($totalPrice, 2);
                                                                    ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold">
                                                <strong>Order Total</strong>
                                            </td>
                                            <td class="text-black font-weight-bold">
                                                <strong><?php
                                                        $totalPrice = 0;
                                                        foreach ($cartItems as $cartItem) {
                                                            $totalPrice += $cartItem['total_price'];
                                                        }
                                                        echo '$' . number_format($totalPrice + 50, 2);
                                                        ?></strong>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>

                                <div class="form-group pt-3">

                                    <input type="hidden" name="product_id" value="<?= $_SESSION['user_id']; ?>">
                                    <input type="hidden" name="total_price" value="<?= $totalPrice  ?>">
                                    <button type="submit" class="cart-btn btn btn-black btn-lg py-3 btn-block">
                                        Place Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include_once "components/footer.php";
include_once "components/scripts.php";
?>

</body>

</html>
<script>
    $(document).ready(function() {

        $(document).on('submit', '#addForm', function(e) {
            sendFormAJAX(e);

        });
    });
</script>