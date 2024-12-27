<?php
include_once '../classes/product.class.php';
$product = new Product();
$products = $product->getProductsByCreatedAt();
?>
<section id="billboard" class="bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="section-title text-center mt-4" data-aos="fade-up">
                New Collections
            </h1>
            <div
                class="col-md-6 text-center"
                data-aos="fade-up"
                data-aos-delay="300">
                <p>
                    Discover our exciting new collection at Lara Boutique!
                    We've just launched new stylish and comfortable clothing for women and kids.
                    From trendy outfits to timeless classics, there's something for every occasion.

                </p>
            </div>
        </div>
        <div class="row">
            <div
                class="swiper main-swiper py-4"
                data-aos="fade-up"
                data-aos-delay="600">
                <div class="swiper-wrapper d-flex border-animation-left">
                    <?php
                    foreach ($products as $product) {
                    ?>
                        <div class="swiper-slide">
                            <div class="banner-item image-zoom-effect">
                                <div class="image-holder">
                                    <a href="#">
                                        <img
                                            src="../admin/images/<?php echo $product['product_image'] ?>"
                                            alt="product"
                                            class="img-fluid" />
                                    </a>
                                </div>
                                <div class="banner-content py-4">
                                    <h5 class="element-title text-uppercase">
                                        <a href="viewProduct.php?product_id=<?php echo $product['product_id'] ?>" class="item-anchor"><?php echo $product['product_name'] ?></a>
                                    </h5>
                                    <p>
                                        <?php echo $product['product_description'] ?>
                                    </p>
                                    <div class="btn-left">
                                        <button class="btn discoverme-button d-flex align-items-center gap-2">
                                            <a href="viewProduct.php?product_id=<?php echo $product['product_id'] ?>" class="button-text">Discover Now</a>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
                                        </button>

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
            <div class="icon-arrow icon-arrow-left"
                data-aos="fade-right">
                <svg width="50" height="50" viewBox="0 0 24 24">
                    <use xlink:href="#arrow-left"></use>
                </svg>
            </div>
            <div class="icon-arrow icon-arrow-right"
                data-aos="fade-left">
                <svg width="50" height="50" viewBox="0 0 24 24">
                    <use xlink:href="#arrow-right"></use>
                </svg>
            </div>
        </div>
    </div>
</section>