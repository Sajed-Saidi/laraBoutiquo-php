<?php
include_once '../classes/category.class.php';
$category = new Category();
$categories = $category->getAllCategories();
?>
<section class="categories overflow-hidden product-carousel py-4 position-relative" id="categories">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
            <h4 class="text-uppercase">Categories</h4>
        </div>
        <div class="swiper product-swiper open-up" data-aos="zoom-out">
            <div class="swiper-wrapper d-flex">
                <?php
                foreach ($categories as $category) {
                ?>
                    <div class="swiper-slide">
                        <div class="cat-item image-zoom-effect">
                            <div class="image-holder" style="height: 400px;">
                                <form action="shop.php" method="GET" class="category-form">
                                    <div class="category-item">
                                        <div class="img-cont">
                                            <img src="../admin/images/<?php echo htmlspecialchars($category['category_image']); ?>" alt="categories" class="product-image img-fluid" onclick="() => test()" />
                                        </div>
                                        <input type="hidden" name="categories[]" value="<?php echo htmlspecialchars($category['category_name']); ?>" />
                                    </div>
                                </form>
                            </div>
                            <div class="category-content">
                                <div class="product-button">
                                    <a href="index.html" class="btn btn-common text-uppercase"><?php echo $category['category_name'] ?></a>
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