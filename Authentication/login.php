<?php
session_start();

if (isset($_SESSION['user_id'])) {
    if (!$role) {
        header("location: /uphols/Backend/Routes/Logout.php");
    } else if ($role == 1) {
        header("location: /uphols/Frontend/Public/Users/Admin/index.php");
    } else if ($role == 2) {
        header("location: /uphols/Frontend/Public/Users/Members/Employee/index.php");
    } else if ($role == 3) {
        header("location: /Uphols/Frontend/Public/Users/Members/Customer/profile.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upholstery - Login</title>
    <link rel="stylesheet" href="/uphols/Assets/Plugins/Aos/Aos.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/theme.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/multistep.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/functions.css">
    <script src="https://kit.fontawesome.com/d41feec2f9.js" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/uphols/Assets/Plugins/Toastr/toastr.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Plugins/Toastr/toastrColor.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/authCustom.css">
</head>

<body>
    <div id="auth-content">
        <section class="container-fluid d-flex flex-column">
            <div class="row align-items-center justify-content-center g-0 min-vh-100">
                <div class="col-lg-4 col-md-8">
                    <div class="card shadow-lg">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <a href="../index.php">
                                        <img src="/uphols/Assets/Images/mainLogo.png" width="170" alt="UpholsteryLogo">
                                    </a>
                                </div>
                                <h1 class="mb2 fs-4">Sign in</h1>
                                <span class="fs-5">Don’t have an account? <a href="register.php" class="ms-1">Sign up</a></span>
                            </div>
                            <form @submit="Login">
                                <div class="mb-2">
                                    <label for="email" class="fs-5 mb-1">Username or email</label>
                                    <input type="text" name="Username" v-model="userEmail" class="form-control form-control-md" placeholder="Enter Username or Email">
                                </div>
                                <div class="mb-2">
                                    <label for="password" class="fs-5 mb-1">Password</label>
                                    <input type="password" name="Password" class="form-control form-control-md" placeholder="Enter password">
                                </div>
                                <div class="d-lg-flex justify-content-between align-items-center mb-5">
                                    <div class="fs-5">
                                        <a href="forgotPasswordConfiguration/forgotpassword.php">Forgot your password?</a>
                                    </div>
                                </div>
                                <div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Sign in</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="/uphols/Backend/Middleware/Vue/axios.js"></script>
    <script src="/uphols/Backend/Middleware/Vue/vue.3.js"></script>
    <script src="/uphols/Backend/Middleware/Auth/Authentic.js"></script>
    <script src="/uphols/Assets/Js/jquery.js"></script>
    <script src="/uphols/Assets/Js/multistep.js"></script>
    <script src="/uphols/Assets/Js/theme.min.js"></script>
    <script src="/uphols/Assets/Plugins/Aos/Aos.min.js"></script>
    <script src="/uphols/Assets/Plugins/Toastr/toastr.min.js"></script>
    <script>
        AOS.init({
            duration: 2000
        });
    </script>
</body>