<?php
include_once 'components/header.php';
include_once 'components/navbar.php';
include_once '../classes/cart.class.php';
include_once '../classes/wishlist.class.php';
include_once '../classes/product.class.php';
include_once '../classes/category.class.php';

$category = new Category();
$categories = $category->getAllCategories();
$product = new Product();
$limit = 6;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

$selected_categories = isset($_GET['categories']) ? $_GET['categories'] : [];

$products = $product->getPaginatedProducts($page, $limit, $selected_categories, $search_query);
$total_products = $product->getTotalProductsCount($selected_categories, $search_query);
$total_pages = ceil($total_products / $limit);

?>

<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Shop</h1>
                </div>
            </div>
            <div class="col-lg-7"></div>
        </div>
    </div>
</div>

<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="shop.php" method="GET">
                            <input type="text" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($search_query); ?>">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                <?php
                                                foreach ($categories as $category) {
                                                    $checked = in_array($category['category_name'], $selected_categories) ? 'checked' : '';
                                                ?>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="category" class="category_checkbox" value="<?php echo $category['category_name'] ?>" <?php echo $checked; ?>>
                                                            <?php echo $category['category_name'] ?>
                                                        </label>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Showing page <span id="currentPage">1</span> of <?php echo $total_pages; ?> pages</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="product-list">
                    <?php
                    if ($total_products > 0) {
                        foreach ($products as $product) {
                    ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="swiper-slide mb-5">
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
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p>No products available for the selected category.</p>';
                    }
                    ?>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination" id="pagination">
                            <a href="?page=<?php echo $page - 1; ?>" <?php echo ($page == 1) ? 'disabled' : ''; ?>><i class="fa-solid fa-chevron-left"></i></a>
                            <?php
                            for ($i = 1; $i <= $total_pages; $i++) {
                                $active = ($i == $page) ? 'active' : '';
                                echo "<a class='$active' href='?page=$i'>$i</a>";
                            }
                            ?>
                            <a href="?page=<?php echo ($page + 1 <= $total_pages) ? $page + 1 : $page; ?>" class="<?php echo ($page == $total_pages) ? 'disabled' : ''; ?>">
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include_once "components/footer.php";
include_once "components/scripts.php";
?>

<script>
    function loadPage(page) {
        var selectedCategories = [];
        $('.category_checkbox:checked').each(function() {
            selectedCategories.push($(this).val());
        });

        var searchQuery = $('input[name="search"]').val(); // Get the current search query

        $.ajax({
            url: 'shop.php',
            type: 'GET',
            data: {
                page: page,
                categories: selectedCategories,
                search: searchQuery // Include the search query in the request
            },
            success: function(response) {
                var newProducts = $(response).find('#product-list').html();
                var newPagination = $(response).find('#pagination').html();
                $('#product-list').html(newProducts);
                $('#pagination').html(newPagination);
                $("#currentPage").html(page);
                document.documentElement.scrollTop = 0;
            }
        });
    }

    $(document).on('click', '.product__pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('=')[1];
        loadPage(page);
    });

    // Handle category checkbox change
    $(document).on('change', '.category_checkbox', function() {
        var selectedCategories = [];
        $('.category_checkbox:checked').each(function() {
            selectedCategories.push($(this).val());
        });

        var searchQuery = $('input[name="search"]').val(); // Get the current search query

        $.ajax({
            url: 'shop.php',
            type: 'GET',
            data: {
                page: 1, // Reset to first page
                categories: selectedCategories,
                search: searchQuery // Include the search query in the request
            },
            success: function(response) {
                var newProducts = $(response).find('#product-list').html();
                var newPagination = $(response).find('#pagination').html();
                $('#product-list').html(newProducts);
                $('#pagination').html(newPagination);
                $("#currentPage").html(1);
            }
        });
    });

    // Search input change
    $(document).on('input', 'input[name="search"]', function() {
        var searchQuery = $(this).val(); // Get the current search query
        loadPage(1); // Reload the page with the search query
    });

    $(document).ready(function() {
        $('a.disabled').on('click', function(e) {
            e.preventDefault();
            return false;
        });
    });
</script>

</body>

</html>