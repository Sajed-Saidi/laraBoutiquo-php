<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Marcellus&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/me.css">
</head>

<body>
    <div class="login-container">
        <div class="login">
            <div class="top-left"><a href="index.php"><i class="fa-solid fa-arrow-left" style="color: #111;"></i></a></div>
            <h3 class="text-center">Login</h3>
            <form action="backend/loginUser.php" method="POST" id="loginForm">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="user_name" placeholder="Enter your username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <button type="submit" class="cart-btn btn  w-100">Login</button>

            </form>
            <div class="mt-4 text-center">
                <p>Don't have an account? <a href="register.php" class="register-link  ">Register here</a></p>
            </div>
        </div>
    </div>
    <?php include_once "components/scripts.php";  ?>

</body>

</html>
<script>
    $(document).ready(function() {

        $(document).on('submit', '#loginForm', function(e) {
            sendFormAJAX(e);
        });

    });
</script>