<?php

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 1) {
        header("location: /uphols/Frontend/Public/Users/Admin/index.php");
    } else if ($_SESSION['role'] == 2) {
        header("location: /uphols/Frontend/Public/Users/Members/Employee/index.php");
    } else if ($_SESSION['role'] == 3) {
        header("location: /uphols/Frontend/Public/Users/Members/Customer/profile.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upholstery - <?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="/uphols/Assets/Css/theme.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/colors.css">
    <link rel="stylesheet" href="/uphols/Assets/Plugins/Aos/Aos.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/functions.css">
    <script src="https://kit.fontawesome.com/d41feec2f9.js" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/uphols/Assets/Plugins/Toastr/toastr.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Plugins/Toastr/toastrColor.css">
    <style>
        .hover-line-border {
            text-decoration: none;
            color: #333;
            border-bottom: 2px solid transparent;
            transition: border-bottom 0.3s;
        }

        .hover-line-border:hover {
            border-bottom: 2px solid #007bff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container p-3">
            <img src="/uphols/Assets/Images/mainLogo.png" width="90" alt="UpholsteryLogo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-bold  ">
                    <li class="nav-item"><a class="nav-link  fw-bold hover-line-border" aria-current="page" href="#!">Home</a></li>
                    <li class="nav-item"><a class="nav-link  fw-bold hover-line-border" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link  fw-bold hover-line-border" href="#projects">Project</a></li>
                    <li class="nav-item"><a class="nav-link  fw-bold hover-line-border" href="#aboutUS">About Us</a></li>
                    <li class="nav-item me-4"><a class="nav-link  fw-bold hover-line-border" href="#contactUs">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link  fw-bold hover-line-border" href="/uphols/Authentication/login.php">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of the Header Code -->