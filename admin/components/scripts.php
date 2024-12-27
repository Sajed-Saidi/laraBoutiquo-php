<!-- Required vendors -->
<script src="./vendor/global/global.min.js"></script>
<script src="./js/quixnav-init.js"></script>
<script src="./js/custom.min.js"></script>

<!-- Vectormap -->
<script src="./vendor/raphael/raphael.min.js"></script>
<script src="./vendor/morris/morris.min.js"></script>

<script src="./vendor/circle-progress/circle-progress.min.js"></script>
<script src="./vendor/chart.js/Chart.bundle.min.js"></script>

<script src="./vendor/gaugeJS/dist/gauge.min.js"></script>

<!--  flot-chart js -->
<script src="./vendor/flot/jquery.flot.js"></script>
<script src="./vendor/flot/jquery.flot.resize.js"></script>

<!-- Owl Carousel -->
<script src="./vendor/owl-carousel/js/owl.carousel.min.js"></script>

<!-- Counter Up -->
<script src="./vendor/jqvmap/js/jquery.vmap.min.js"></script>
<script src="./vendor/jqvmap/js/jquery.vmap.usa.js"></script>
<script src="./vendor/jquery.counterup/jquery.counterup.min.js"></script>

<script src="./js/dashboard/dashboard-1.js"></script>
<script src="./js/jquery-3.7.1.js"></script>
<script src="./js/dataTable.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
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
    new DataTable('#myDataTable');
</script>