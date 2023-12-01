<?php
session_start();
$role = $_SESSION['role'];

if (!isset($_SESSION['user_id'])) {
    if ($role == 2) {
        header("location: /uphols/Frontend/Public/Users/Members/Employee/index.php");
    } else if ($role == 3) {
        header("location: /Uphols/Frontend/Public/Users/Members/Customer/profile.php");
    } else {
        header("location: /uphols/Frontend/Public/Users/notFound.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upholstery - <?php echo $pageTitle; ?></title>
    <!-- Styles or the design styles css of the system -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> -->
    <link rel="stylesheet" href="/uphols/Assets/Css/simplebar.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/theme.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/colors.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/functions.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/fontawesome.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
    <!-- The Css of toastr -->
    <link rel="stylesheet" href="/uphols/Assets/Plugins/Toastr/toastr.min.css">
    <!-- The color of toastr -->
    <link rel="stylesheet" href="/uphols/Assets/Plugins/Toastr/toastrColor.css">
    <!-- Custom css only for admin -->
    <link rel="stylesheet" href="/Uphols/Assets/Css/adminCustom.css">
    <!-- Script for the loading -->
    <script src="/Uphols/Assets/Js/loading.js"></script>
    <!-- Font awesome kit  -->
    <script src="https://kit.fontawesome.com/d41feec2f9.js" crossorigin="anonymous"></script>
    <style>
        .border-right {
            border-right: 1px solid gray;
        }

        <?php
        $sad = "color: white";
        if ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/index.php') {
            echo '.dashboardLink {' . $sad . '}';
        } else if ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/index.php') {
            echo '.dashboardLink {' . $sad . '}';
        } else if ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/index.php') {
            echo '.dashboardLink {' . $sad . '}';
        } elseif ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Customers/index.php') {
            echo '.usersLink {' . $sad . '}';
        } elseif ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Requests/index.php') {
            echo '.RequestLink {' . $sad . '}';
        } elseif ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Orders/index.php') {
            echo '.orderSalesLink {' . $sad . '}';
        } elseif ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Products/index.php') {
            echo '.productLink {' . $sad . '}';
        } elseif ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Recommendation/index.php') {
            echo '.recommendationLink {background-color: #FFB703; width: 123%; background-color: #FFB703; border-radius: 3px; padding-left: 10px; padding-right: 10px;}';
        } elseif ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Designs/index.php') {
            echo '.designLink {' . $sad . '}';
        }
        ?>
    </style>
</head>

<body>
    <!-- Start of the Header Code -->
    <div class="container-fluid p-0">
        <div class="row vh-100">
            <div class="col-4 navbar-vertical navbar px-3">
                <div class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-link">
                    <a href="/" class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-link text-decoration-none">
                        <span class="fs-5 text-center"><img src="/Uphols/Assets/Images/upholsteryLogo.png" width="70" alt=""><span class="ms-1 mt-4 h3 d-none d-sm-inline fw-bold text-title">Upholstery</span></span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-sm-column flex-row flex-nowrap flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start" id="menu">
                        <li class="my-2 active">
                            <a href="/uphols/Frontend/Public/Users/Admin/index.php" class="nav-link px-sm-0 sidebar dashboardLink ">
                                <i class="fa-solid fa-chart-line" style="color: #005eff;"></i>
                                <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                            </a>
                        </li>
                        <li class="my-2">
                            <a href="/uphols/Frontend/Public/Users/Admin/Customers/index.php" class="nav-link px-sm-0 sidebar usersLink">
                                <i class="fa-solid fa-users" style="color: #005eff;"></i>
                                <span class="ms-1 d-none d-sm-inline">Users</span>
                            </a>
                        </li>
                        <li class="nav-item hover mb-1">
                            <a class="nav-link" href="/uphols/Frontend/Public/Users/Admin/chat.php">
                                <i class="fa fa-comment pe-2" aria-hidden="true"></i>Chat
                            </a>
                        </li>
                        <li class="my-2">
                            <a href="/uphols/Frontend/Public/Users/Admin/Requests/index.php" class="nav-link px-sm-0 sidebar RequestLink">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                                <span class="ms-1 d-none d-sm-inline">Request</span>
                            </a>
                        </li>
                        <li class="my-2">
                            <a href="/uphols/Frontend/Public/Users/Admin/Orders/index.php" class="nav-link px-sm-0 sidebar orderSalesLink">
                                <i class="fa-solid fa-box-open" style="color: #005eff;"></i>
                                <span class="ms-1 d-none d-sm-inline">Orders</span>
                            </a>
                        </li>
                        <li class="my-2">
                            <a href="/uphols/Frontend/Public/Users/Admin/Products/index.php" class="nav-link px-sm-0 sidebar productLink">
                                <i class="fa-solid fa-envelopes-bulk" style="color: #005eff;"></i>
                                <span class="ms-1 d-none d-sm-inline">Product</span>
                            </a>
                        </li>
                        <li class="my-2">
                            <a href="/uphols/Frontend/Public/Users/Admin/Designs/index.php" class="nav-link px-sm-0 sidebar designLink">
                                <i class="fa-solid fa-comments" style="color: #005eff;"></i>
                                <span class="ms-1 d-none d-sm-inline">Designs</span>
                            </a>
                        </li>
                        <li class="my-2">
                            <a href="/uphols/Frontend/Public/Users/Admin/Recommendation/index.php" class="nav-link px-sm-0 sidebar recommendationLink">
                                <i class="fa-solid fa-comments" style="color: #005eff;"></i>
                                <span class="ms-1 d-none d-sm-inline">Recommendation</span>
                            </a>
                        </li>
                    </ul>
                    <div class="py-sm-4 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
                        <a href="#" class="d-flex align-items-center text-link text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="/Uphols/Assets/Images/<?php echo $_SESSION['profile'] ?>" width="28" height="28" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1"><?php echo $_SESSION['firstname']; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutConfirmation" style="cursor: pointer;">Logout</a></li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="logoutConfirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Logout Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="title">
                                Are you sure you want to Logout?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="/uphols/Backend/Routes/Logout.php">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Logout</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of the Header Code -->