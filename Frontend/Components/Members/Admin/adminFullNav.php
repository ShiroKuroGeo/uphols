<?php
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
    <!-- <link rel="stylesheet" href="/uphols/Assets/Css/style.css"> -->
    <link rel="stylesheet" href="/uphols/Assets/Css/simplebar.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/theme.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/colors.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <!-- The functions css -->
    <link rel="stylesheet" href="/uphols/Assets/Css/functions.css">
    <!-- Font awesome or the Icons of bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
</head>
<style>
    .hover:hover {
        background-color: #F1F5F9;
        border-right: none;
        color: black;
    }
    .dash{
        font-size: 120px;
    }

    <?php
        $sad = "color: red";
        if ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/index.php') {
            echo '.dash {' . $sad . '}';
        } else if ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/index.php') {
            echo '.dash {' . $sad . '}';
        } else if ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/index.php') {
            echo '.dash {' . $sad . '}';
        } elseif ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Customers/index.php') {
            echo '.user {' . $sad . '}';
        } elseif ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Requests/index.php') {
            echo '.req {' . $sad . '}';
        } elseif ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Orders/index.php') {
            echo '.ord {' . $sad . '}';
        } elseif ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Products/index.php') {
            echo '.pro {' . $sad . '}';
        } elseif ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Recommendation/index.php') {
            echo '.rec {'.$sad.'}';
        } elseif ($_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Designs/index.php') {
            echo '.de {' . $sad . '}';
        }
    ?>
</style>

<body>
    <div id="db-wrapper">
        <nav class="navbar-vertical navbar">
            <div class="vh-100" data-simplebar>
                <a class="d-flex justify-content-center" href="/uphols/Frontend/Public/Users/Admin/index.php">
                    <img src="/uphols/Assets/Images/upholsterylogoAdmin.png" class="navbar-brand img-fluid" style="border-radius: 35px; height: 120px; border: 0" alt="UpholsteryLogo">
                </a>
                <ul class="navbar-nav flex-column" id="sideNavbar">
                    <li class="nav-item hover mb-1">
                        <a class="<?php echo $_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/index.php' ? 'nav-link active' : 'nav-link'?>" href="/uphols/Frontend/Public/Users/Admin/index.php">
                            <i class="fa-solid pe-2 fa-chart-line"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item hover mb-1 user">
                        <a class="<?php echo $_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Customers/users.php' ? 'nav-link active' : 'nav-link'?>" href="/uphols/Frontend/Public/Users/Admin/Customers/users.php">
                            <i class="fa-solid pe-2 fa-users"></i>Users
                        </a>
                    </li>
                    <li class="nav-item hover mb-1 req">
                        <a class="<?php echo $_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Requests/index.php' ? 'nav-link active' : 'nav-link'?>" href="/uphols/Frontend/Public/Users/Admin/Requests/index.php">
                            <i class="fa pe-2 fa-truck" aria-hidden="true"></i>Requests
                        </a>
                    </li>
                    <li class="nav-item hover mb-1 ord">
                        <a class="<?php echo $_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Orders/index.php' ? 'nav-link active' : 'nav-link'?>" href="/uphols/Frontend/Public/Users/Admin/Orders/index.php">
                            <i class="fa pe-2 fa-opencart" aria-hidden="true"></i>Orders
                        </a>
                    </li>
                    <li class="nav-item hover pro mb-1">
                        <a class="<?php echo $_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Products/index.php' ? 'nav-link active' : 'nav-link'?>" href="/uphols/Frontend/Public/Users/Admin/Products/index.php">
                            <i class="fa pe-2 fa-shopping-cart" aria-hidden="true"></i>Products
                        </a>
                    </li>
                    <li class="nav-item hover mb-1 de">
                        <a class="<?php echo $_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Designs/index.php' ? 'nav-link active' : 'nav-link'?>" href="/uphols/Frontend/Public/Users/Admin/Designs/index.php">
                            <i class="fa pe-2 fa-paint-brush" aria-hidden="true"></i>Designs
                        </a>
                    </li>
                    <li class="nav-item hover mb-1 rec">
                        <a class="<?php echo $_SERVER['PHP_SELF'] == '/uphols/Frontend/Public/Users/Admin/Recommendation/index.php' ? 'nav-link active' : 'nav-link'?>" href="/uphols/Frontend/Public/Users/Admin/Recommendation/index.php">
                            <i class="fa pe-2 fa-thumbs-up" aria-hidden="true"></i>Recommendations
                        </a>
                    </li>
            </div>
        </nav>
        <main id="page-content">
            <div class="header">
                <nav class="navbar-default navbar navbar-expand-lg">
                    <a id="nav-toggle" href="#">
                        <i class="fa fa-bars text-muted" aria-hidden="true"></i>
                    </a>
                    <div class="ms-auto d-flex">
                        <ul class="navbar-nav navbar-right-wrap ms-2 d-flex nav-top-wrap">
                            <li class="dropdown ms-2">
                                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md avatar-indicators avatar-online">
                                        <img alt="avatar" src="/Uphols/Assets/Images/<?php echo $_SESSION['profile'] ?>" class="rounded-circle">
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                    <div class="dropdown-item">
                                        <div class="d-flex">
                                            <div class="avatar avatar-md avatar-indicators avatar-online">
                                                <img alt="avatar" src="/Uphols/Assets/Images/<?php echo $_SESSION['profile'] ?>" class="rounded-circle">
                                            </div>
                                            <div class="ms-3 lh-1">
                                                <h5 class="mb-1"><?php echo $_SESSION['firstname']; ?></h5>
                                                <p class="mb-0 text-muted"><?php echo $_SESSION['lastname']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="dropdown-item" href="../../../index.html" data-bs-toggle="modal" data-bs-target="#logoutConfirmation" style="cursor: pointer;">
                                                <i class="fa fa-power-off me-2" aria-hidden="true"></i> Sign Out
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="modal fade" id="logoutConfirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Logout Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
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