<?php
include_once '../classes/wishlist.class.php';
include_once '../classes/cart.class.php';
include_once '../classes/product.class.php';
$product = new Product();
$products = $product->getRandomProducts();
?>
<section id="related-products" class="related-products product-carousel py-5 position-relative overflow-hidden">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
            <h4 class="text-uppercase">You May Also Like</h4>
            <a href="shop.php" class="btn-link">View All Products</a>
        </div>
        <div class="swiper product-swiper open-up" data-aos="zoom-out">
            <div class="swiper-wrapper d-flex">
                <?php
                foreach ($products as $product) {
                ?>
                    <div class="swiper-slide">
                        <div class="product-item image-zoom-effect link-effect">
                            <?php
                            $isInCart = false;
                            $isInwishlist = false;

                            if (isset($_SESSION['login'])) {
                                $cart = new Cart();
                                $isInCart = $cart->isProductInCart($user_id, $product['product_id']);
                                $wishlist = new Wishlist();
                                $isInwishlist = $wishlist->isProductInwhishlist($user_id, $product['product_id']);
                            }
                            ?>
                            <div class="image-holder">
                                <a href="viewProduct.php?product_id=<?php echo $product['product_id'] ?>">
                                    <img src="../admin/images/<?php echo $product['product_image'] ?>" alt="product" class="product-image img-fluid" />
                                </a>
                                <a href="#" class="btn-icon btn-wishlist addToWishlistBtn" data-inWishlist='<?= json_encode($isInwishlist) ?>' data-user_id='<?php echo json_encode($user_id) ?>' data-product='<?php echo json_encode($product) ?>'>
                                    <i class="fa<?php echo $isInwishlist ? '' : '-regular' ?> fa-heart"></i>
                                </a>
                                <div class="product-content">
                                    <h5 class="text-uppercase fs-5 mt-3">
                                        <a href="viewProduct.php?product_id=<?php echo $product['product_id'] ?>"><?php echo $product['product_name'] ?></a>
                                    </h5>
                                    <a href="#" class="addToCartBtn text-decoration-none" data-inCart='<?= json_encode($isInCart) ?>' data-after="<?php if ($isInCart) {
                                                                                                                                                        echo "In Cart";
                                                                                                                                                    } else {
                                                                                                                                                        echo "Add to Cart";
                                                                                                                                                    } ?>" data-user_id='<?php echo json_encode($user_id) ?>' data-product='<?php echo json_encode($product) ?>'>
                                        <span>$<?php echo $product['product_price'] ?></span>

                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="icon-arrow icon-arrow-left">
            <svg width="50" height="50" viewBox="0 0 24 24">
                <use xlink:href="#arrow-left"></use>
            </svg>
        </div>
        <div class="icon-arrow icon-arrow-right">
            <svg width="50" height="50" viewBox="0 0 24 24">
                <use xlink:href="#arrow-right"></use>
            </svg>
        </div>
    </div>
</section>