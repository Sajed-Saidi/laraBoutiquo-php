<script src="js/jquery.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/SmoothScroll.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="js/script.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('input[type="text"],textarea,input[type="password"]').on('input', function() {
        var trimmedValue = $(this).val().trim();
        if (trimmedValue == "") {
            $(this).val(trimmedValue);
        }
    });

    $('form button[type="submit"]').on("click", function() {
        $('form input[type="text"]').each(function() {
            var trimmedValue = $(this).val().trim();
            $(this).val(trimmedValue);
        });
    })
</script>
<script>
    function sendFormAJAX(e) {
        e.preventDefault();
        var form = $(e.target); // The form element
        var formData = new FormData(form[0]); // Create FormData from form
        console.log(form);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            processData: false,
            contentType: false,
            dataType: 'json',
            data: formData,
            success: function(response) {
                console.log(response);
                Swal.fire({
                    icon: response.status === 'success' ? 'success' : 'warning',
                    title: response.message,
                    showConfirmButton: true,
                    confirmButtonColor: '#4D869C', // Primary color
                    customClass: {
                        confirmButton: 'button btn btn-primary app_style',
                        title: 'swal-title',
                        htmlContainer: 'swal-html',
                        content: 'swal-content'
                    }
                }).then(function() {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                });

            },
            error: function(xhr, status, error) {
                console.log('AJAX Error: ' + status + error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'AJAX Error!',
                    showConfirmButton: true,
                    confirmButtonColor: '#4D869C', // Primary color
                    customClass: {
                        confirmButton: 'button btn btn-primary app_style',
                        title: 'swal-title',
                        htmlContainer: 'swal-html',
                        content: 'swal-content'
                    }
                });
            }
        });
    }

    function sendDeleteAJAX(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4D869C', // Primary color
            cancelButtonColor: '#7AB2B2', // Secondary color
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            customClass: {
                title: 'swal-title',
                htmlContainer: 'swal-html',
                content: 'swal-content'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                sendFormAJAX(e);
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.addToCartBtn', function(e) {
            e.preventDefault();

            var inCart = JSON.parse($(this).attr('data-inCart'));

            if (inCart) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Product is already in cart!',
                    showConfirmButton: true,
                    confirmButtonColor: '#4D869C', // Primary color
                    customClass: {
                        confirmButton: 'button btn btn-primary app_style',
                        title: 'swal-title',
                        htmlContainer: 'swal-html',
                        content: 'swal-content'
                    }
                });
                return;
            }
            var product = (JSON.parse($(this).attr('data-product')));
            var user_id = $(this).attr('data-user_id');

            $.ajax({
                url: 'backend/addToCart.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    product_id: product.product_id,
                    product_price: product.product_price,
                    user_id: user_id
                },
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        icon: response.status === 'success' ? 'success' : 'warning',
                        title: response.message,
                        showConfirmButton: true,
                        confirmButtonColor: '#4D869C', // Primary color
                        customClass: {
                            confirmButton: 'button btn btn-primary app_style',
                            title: 'swal-title',
                            htmlContainer: 'swal-html',
                            content: 'swal-content'
                        }
                    }).then(function() {
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    });

                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error: ' + status + error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'AJAX Error!',
                        showConfirmButton: true,
                        confirmButtonColor: '#4D869C', // Primary color
                        customClass: {
                            confirmButton: 'button btn btn-primary app_style',
                            title: 'swal-title',
                            htmlContainer: 'swal-html',
                            content: 'swal-content'
                        }
                    });
                }
            });
        })
        $(document).on('click', '.addToWishlistBtn', function(e) {
            e.preventDefault();

            var inWishlist = JSON.parse($(this).attr('data-inWishlist'));

            if (inWishlist) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Product is already in wishlist!',
                    showConfirmButton: true,
                    confirmButtonColor: '#4D869C', // Primary color
                    customClass: {
                        confirmButton: 'button btn btn-primary app_style',
                        title: 'swal-title',
                        htmlContainer: 'swal-html',
                        content: 'swal-content'
                    }
                });
                return;
            }
            var product = (JSON.parse($(this).attr('data-product')));
            var user_id = $(this).attr('data-user_id');

            $.ajax({
                url: 'backend/addToWishlist.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    product_id: product.product_id,
                    product_price: product.product_price,
                    user_id: user_id
                },
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        icon: response.status === 'success' ? 'success' : 'warning',
                        title: response.message,
                        showConfirmButton: true,
                        confirmButtonColor: '#4D869C', // Primary color
                        customClass: {
                            confirmButton: 'button btn btn-primary app_style',
                            title: 'swal-title',
                            htmlContainer: 'swal-html',
                            content: 'swal-content'
                        }
                    }).then(function() {
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    });

                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error: ' + status + error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'AJAX Error!',
                        showConfirmButton: true,
                        confirmButtonColor: '#4D869C', // Primary color
                        customClass: {
                            confirmButton: 'button btn btn-primary app_style',
                            title: 'swal-title',
                            htmlContainer: 'swal-html',
                            content: 'swal-content'
                        }
                    });
                }
            });
        })
    });
</script>

<?php
if (isset($_SESSION['message'])) {
    var_dump($_SESSION['message']);
?>
    <script>
        $(document).ready(function() {
            Swal.fire({
                icon: 'warning',
                title: <?php echo json_encode($_SESSION['message']) ?>,
                showConfirmButton: true,
                confirmButtonColor: '#4D869C', // Primary color
                customClass: {
                    confirmButton: 'button btn btn-primary app_style',
                    title: 'swal-title',
                    htmlContainer: 'swal-html',
                    content: 'swal-content'
                }
            });
        });
    </script>
<?php
    unset($_SESSION['message']);
}
?>