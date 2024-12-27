<?php
$page = basename($_SERVER['PHP_SELF']);

?>
<nav class="navbar navbar-expand-lg bg-light text-uppercase fs-6 p-3 border-bottom align-items-center">
    <div class="container-fluid">
        <div class="row justify-content-between align-items-center w-100">
            <div class="col-auto">
                <a class="navbar-brand " href="index.php" style="font-size: 30px; font-family:'Marcellus', Roboto, sans-serif;">
                    Boutique Lara
                </a>
            </div>
            <div class="col-auto">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 gap-1 gap-md-5 pe-3">
                            <li class="nav-item">
                                <a class="nav-link <?= $page == 'index.php' ? 'active' : '' ?>" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $page == 'shop.php' ? 'active' : '' ?>" href="shop.php">Shop</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdownBlog" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blog</a>
                                <ul class="dropdown-menu list-unstyled" aria-labelledby="dropdownBlog">
                                    <li>
                                        <a href="#billboard" class="dropdown-item item-anchor">New Collection
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#features" class="dropdown-item item-anchor">features
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#categories" class="dropdown-item item-anchor">Categories
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#new-arrival" class="dropdown-item item-anchor">New Arrivals
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#best-sellers" class="dropdown-item item-anchor">Best selling items
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#video" class="dropdown-item item-anchor">video
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#complements" class="dropdown-item item-anchor">complements
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#related-products" class="dropdown-item item-anchor">you may like
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $page == 'about.php' ? 'active' : '' ?>" href="about.php">About US</a>
                            </li>
                            <?php if (isset($_SESSION['login']) && ($_SESSION['role'] == "admin")) { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="../admin/index.php">
                                        Admin
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-3 col-lg-auto">
                <ul class="list-unstyled d-flex m-0">
                    <li class="d-lg-block">
                        <a href="wishlist.php" class="mx-2">
                            <i class="fa-regular fa-heart" style="font-size: 20px;"></i>
                        </a>
                    </li>
                    <?php
                    if (isset($_SESSION['login'])) {
                    ?>
                        <li class="d-lg-block">
                            <a href="cart.php" class="mx-2">
                                <i class="fa-solid fa-cart-shopping" style="font-size: 20px;"></i>
                            </a>
                        </li>

                        <li class="d-lg-block">
                            <a href="orders.php" class="mx-2">
                                <i class="fa-solid fa-truck-fast" style="font-size: 20px;"></i>
                            </a>
                        </li>


                        <li class="d-lg-block">
                            <a href="backend/logout.php" class="mx-2">
                                <i class="fa-solid fa-sign-out" style="font-size: 20px;"></i>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="d-lg-block">
                            <a href="login.php" class="mx-2">
                                <i class="fa-solid fa-user" style="font-size: 20px;"></i>
                            </a>
                        </li>
                        <li class="d-lg-block">
                            <a href="cart.php" class="mx-2">
                                <i class="fa-solid fa-cart-shopping" style="font-size: 20px;"></i>
                            </a>
                        </li>
                    <?php
                    }
                    ?>


                </ul>
            </div>
        </div>
    </div>
</nav>