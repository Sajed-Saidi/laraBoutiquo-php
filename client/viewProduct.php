<?php
include_once 'components/header.php';
include_once 'components/navbar.php';
include_once '../classes/product.class.php';
include_once '../classes/cart.class.php';
include_once '../classes/wishlist.class.php';

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $product = new Product();
    $products = $product->getProductById($product_id);
}
$isInCart = false;
$isInwishlist = false;
if (isset($_SESSION['login'])) {
    $user_id = $_SESSION['user_id'];

    $wishlist = new Wishlist();
    $isInwishlist = $wishlist->isProductInwhishlist($user_id, $product_id);
    $cart = new Cart();
    $isInCart = $cart->isProductInCart($user_id, $product_id);
}
?>
<section class="viewProduct bg-light position-relative py-5">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between flex-column flex-md-row my-5">
                <?php
                foreach ($products as $product) {
                ?>
                    <div class="col-12 col-md-6 column-container bg-white  mb-md-0">
                        <img class="img-fluid" src="../admin/images/<?php echo $product['product_image'] ?>" style="width: 100vw; height: 100vh; object-fit: cover;" alt="Product Image">
                    </div>
                    <div class="col-12 col-md-6  column-container bg-white" data-aos="fade-left">
                        <div class="m-0 m-md-5 p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="top-left">
                                    <a href="index.php">
                                        <i class="fa-solid fa-chevron-left" style="color: #111; font-size: 15px;"></i>
                                        <span style="font-weight: bold; margin-left: 8px;">Back</span>
                                    </a>
                                </div>
                                <div>
                                    <form method="POST" action="backend/addTowishlist.php" id="addTowishlistForm">
                                        <?php
                                        if ($isInwishlist) {
                                        ?>
                                            <button type="submit" class="btn text-uppercase mt-3 border-0" disabled><i class="fa-solid fa-heart" style="font-size: 20px;color: black;"></i></button>
                                        <?php } else { ?>
                                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                            <input type="hidden" name="product_price" value="<?php echo $product['product_price']; ?>">
                                            <button type="submit" class="btn text-uppercase mt-3"><i class="fa-regular fa-heart" style="font-size: 20px; color: black;"></i></button>
                                        <?php  }  ?>
                                    </form>
                                </div>
                            </div>
                            <h3 class="element-title text-uppercase">
                                <?php echo $product['product_name'] ?>
                            </h3>
                            <p>
                                <?php echo $product['product_description'] ?>
                            </p>
                            <h4 class="product-price">
                                Price: $<?php echo $product['product_price'] ?>
                            </h4>
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
                        </div>
                    </div>
            </div>
        <?php
                }
        ?>
        </div>
    </div>
</section>


<?php
include_once "components/footer.php";
include_once "components/scripts.php";



?>
<script>
    $(document).ready(function() {

        $(document).on('submit', '#addToCartForm', function(e) {
            sendFormAJAX(e);
        });
        $(document).on('submit', '#addTowishlistForm', function(e) {
            sendFormAJAX(e);
        });
    });
</script>