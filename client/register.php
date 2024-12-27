<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
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

    <div class="register-container">
        <div class="register">
            <div class="top-left"><a href="index.php"><i class="fa-solid fa-arrow-left" style="color: #111;"></i></a></div>
            <h3 class="text-center">Register</h3>
            <form action="backend/registerUser.php" method="POST" id="registerForm">

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="user_name" placeholder="Enter your username" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                </div>

                <button type="submit" class="cart-btn btn w-100">Register</button>

                <div class="mt-4 text-center">
                    <p>Already have an account? <a href="login.php" class="login-link " style="color: #9aa1a7;">Login here</a></p>
                </div>
            </form>
        </div>
    </div>

    <?php include_once "components/scripts.php";  ?>

</body>

</html>

<script>
    $(document).ready(function() {

        $(document).on('submit', '#registerForm', function(e) {
            sendFormAJAX(e);
        });

    });
</script>