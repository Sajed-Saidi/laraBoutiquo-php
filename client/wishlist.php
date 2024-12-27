<?php
include_once 'components/header.php';
include_once '../middleware/login.php';
include_once 'components/navbar.php';
require_once "../classes/wishlist.class.php";
require_once "../classes/product.class.php";
require_once "../classes/cart.class.php";

?>
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt mt-5 mb-5">
                    <h1>Wishlist</h1>
                </div>
            </div>
            <div class="col-lg-7"></div>
        </div>
    </div>
</div>

<div class="untree_co-section before-footer-section">
    <div class="container">
        <div class="row mb-5">

            <div class="site-blocks-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="product-thumbnail">Image</th>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-cart">Cart</th>
                            <th class="product-remove">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_SESSION['login'])) {
                            $user_id = $_SESSION['user_id'];
                            $wishlist = new Wishlist();
                            $wishlistItems = $wishlist->getWishlistById($user_id);
                            foreach ($wishlistItems as $wishlistItem) {
                                $product = new Product();
                                $products = $product->getProductById($wishlistItem['product_id']);
                                $cart = new Cart();
                                $isInCart = $cart->isProductInCart($user_id, $wishlistItem['product_id']);
                        ?>
                                <tr>
                                    <?php
                                    foreach ($products as $product) {
                                    ?>
                                        <td class="product-thumbnail">
                                            <img src="../admin/images/<?= $product['product_image']; ?>" alt="Image" class="img-fluid" width="100px" height="100px" />
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black"><?= $product['product_name']; ?></h2>
                                        </td>
                                        <td>$<?= $wishlistItem['price']; ?></td>
                                    <?php
                                    } ?>
                                    <td>
                                        <form method="POST" action="backend/addToCart.php" id="addToCartForm">
                                            <?php
                                            if ($isInCart) {
                                            ?>
                                                <button type="submit" class="about-btn btn btn-dark text-uppercase mt-3" disabled>In Cart</button>
                                            <?php } else { ?>
                                                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                                <input type="hidden" name="product_price" value="<?php echo $product['product_price']; ?>">
                                                <button type="submit" class="about-btn btn btn-dark text-uppercase mt-3">Add to Cart</button>
                                            <?php  }  ?>
                                        </form>
                                    </td>
                                    <td>
                                        <form class='deleteCartForm d-inline' action="backend/deleteWishlist.php" method="POST">
                                            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">
                                            <input type="hidden" name="product_id" value="<?= $wishlistItem['product_id'] ?>">
                                            <button type="submit" class="btn btn-black btn-sm">
                                                <i class="fa-solid fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                </table>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <a href="cart.php" class="cart-btn btn btn-black btn-sm btn-block">Show Cart</a>
                    </div>
                    <div class="col-md-6">
                        <a href="shop.php" class="cart-btn btn btn-black btn-sm btn-block"> Continue Shopping</a>
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
        $(document).on('submit', '#addToCartForm', function(e) {
            sendFormAJAX(e);
        });
    });
</script>