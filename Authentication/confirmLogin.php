<?php
session_start();
session_unset();
session_destroy();
// if (isset($_SESSION['user_id'])) {
//     header("location: /uphols/Frontend/Public/Users/Admin/index.php");
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upholstery - Verification Email</title>
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
                                <a href="../index.php">
                                    <img src="/uphols/Assets/Images/mainLogo.png" width="90" alt="UpholsteryLogo">
                                </a>
                                <h1 class="mb2 fs-4">Sign in</h1>
                                <span class="fs-5">Don’t have an account? <a href="register.php" class="ms-1">Sign up</a></span>
                            </div>
                            <div class="mb-2">
                                <label for="email" class="fs-5 mb-1">Enter Code Send in Email</label>
                                <input type="text" v-model="verifyCodeEmail" class="form-control form-control-md" placeholder="Enter Username or Email">
                            </div>
                            <div>
                                <div class="d-grid">
                                    <button type="button" class="btn btn-primary" @click="verifyEmail">Verify Email Address</button>
                                </div>
                            </div>
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
        toastr.info('Email Verification send!');
        AOS.init({
            duration: 2000
        });
    </script>
</body>