<?php
include_once 'components/header.php';
include_once '../middleware/login.php';
include_once 'components/navbar.php';
require_once "../classes/cart.class.php";
require_once "../classes/product.class.php";
?>

<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt mt-5 mb-5">
                    <h1>Cart</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="untree_co-section before-footer-section">
    <div class="container">
        <div class="row mb-5">
            <div class="site-blocks-table">
                <?php
                if (isset($_SESSION['login'])) {
                    $user_id = $_SESSION['user_id'];
                    $cart = new Cart();
                    $cartItems = $cart->getCartById($user_id);

                    if (count($cartItems) > 0) {
                ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($cartItems as $cartItem) {
                                    $product = new Product();
                                    $products = $product->getProductById($cartItem['product_id']);
                                ?>
                                    <tr>
                                        <?php
                                        foreach ($products as $product) {
                                        ?>
                                            <td class="product-thumbnail">
                                                <img src="../admin/images/<?= $product['product_image']; ?>" alt="Image" class="img-fluid" width="90px" height="90px" />
                                            </td>
                                            <td class="product-name">
                                                <input type="hidden" name="product_totalquantity" class="product_totalquantity" value="<?= $product['product_quantity'] ?>">
                                                <h2 class="h5 text-black"><?= $product['product_name']; ?></h2>
                                            </td>
                                        <?php
                                        } ?>
                                        <td class="price">$<?= $cartItem['price']; ?></td>
                                        <td>
                                            <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-black decrease" type="button">
                                                        &minus;
                                                    </button>
                                                </div>
                                                <input type="hidden" name="product_id" class="product_id" value="<?= $cartItem['product_id'] ?>">
                                                <input type="text" class="form-control text-center quantity-amount" disabled value="<?= $cartItem['quantity']; ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-black increase" type="button">
                                                        &plus;
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="total_price">$<?= $cartItem['total_price']; ?></td>
                                        <td>
                                            <form class='deleteCartForm d-inline' action="backend/deleteCart.php" method="POST">
                                                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">
                                                <input type="hidden" name="product_id" value="<?= $cartItem['product_id'] ?>">
                                                <button type="submit" class="btn btn-black btn-sm">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table><?php
                            } else {
                                ?>
                        <h3 class="text-center">Cart Empty</h3>

                <?php
                            }
                        } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-6">
                        <a href="shop.php" class="cart-btn btn btn-outline-black btn-sm btn-block">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pl-5">
                <div class="row justify-content-end">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12 text-right border-bottom mb-5">
                                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Total</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="total text-black">
                                    <?php
                                    $totalPrice = 0;
                                    foreach ($cartItems as $cartItem) {
                                        $totalPrice += $cartItem['total_price'];
                                    }
                                    echo '$' . number_format($totalPrice, 2);
                                    ?>
                                </strong>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="cart-btn btn btn-black btn-lg py-3 btn-block" onclick="window.location='checkout.php'">
                                    Proceed To Checkout
                                </button>
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
?>

</body>

</html>
<script>
    $(document).ready(function() {

        $(document).on('submit', '.deleteCartForm', function(e) {
            sendDeleteAJAX(e);
        });
    });
    $(document).ready(function() {
        $(".increase, .decrease").on("click", function() {
            var quantityField = $(this).closest('.quantity-container').find('.quantity-amount');
            var quantity = parseInt(quantityField.val());
            var product_totalquantityField = $(this).closest('tr').find('.product_totalquantity');
            var product_totalquantity = product_totalquantityField.val();
            if ($(this).hasClass('increase')) {
                if (quantity < product_totalquantity) {
                    quantity++;
                }
            } else if (quantity > 1) {
                quantity--;
            }
            quantityField.val(quantity);
            var product_idField = $(this).closest('tr').find('.product_id');
            var product_id = product_idField.val();
            var product_price = parseFloat($(this).closest('tr').find('.price').text().replace('$', ''));

            var newTotalPrice = (product_price * quantity).toFixed(2);

            $(this).closest('tr').find('.total_price').text('$' + newTotalPrice);

            $.ajax({
                url: 'backend/updateCart.php',
                method: 'POST',
                data: {
                    product_id: product_id,
                    quantity: quantity
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                }
            });
        });
    });
</script>