<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upholstery Cordova</title>
    <!-- Styles or the design styles css of the system -->
    <link rel="stylesheet" href="/uphols/Assets/Css/colors.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/simplebar.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/theme.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/feather.css">
    <!-- The Css of toastr -->
    <link rel="stylesheet" href="/uphols/Assets/Plugins/Toastr/toastr.min.css">
    <!-- Font awesome or the Icons of bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/uphols/Assets/Css/functions.css">
    <!-- Css font link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <style>
        .custom-dropdown {
            width: 380px;
        }

        .notificationMessage {
            word-wrap: break-word;
        }
    </style>
</head>

<body>
    <!-- Start of the Header Code -->
    <nav class="navbar navbar-expand-lg navbar-light secondaryColor fixed-top" id="customer-profile-header">
        <div class="container px-4 px-lg-5" v-for="cm in customerInfoHeader">
            <a class="navbar-brand" href="index.php">
                <img src="/uphols/Assets/Images/mainLogo.png" width="90" alt="UpholsteryLogo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-lg-0 ms-lg-4">

                </ul>
                <div class="cart d-flex">
                    <div class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted me-2">
                        <a href="cart.php" class="text-decoration-none text-muted">
                            <i class="fa fa-shopping-cart text-muted" height="120"></i><sup class="text-danger">{{ totalMyCarts }}</sup>
                        </a>
                    </div>
                    <div class="dropdown stopevent me-2">
                        <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" href="#" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg" aria-labelledby="dropdownNotification">
                            <div style="width: 350px">
                                <div class="border-bottom px-3 pb-3 d-flex justify-content-between align-items-center">
                                    <span class="h4 mb-0">Notifications Order</span>
                                    <a href="# " class="text-muted">
                                        <span class="align-middle">
                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </div>
                                <!-- List group -->
                                <ul class="list-group list-group-flush" data-simplebar style="max-height: 300px;">
                                    <li class="list-group-item bg-light">
                                        <div class="row">
                                            <div class="col py-2 border-bottom" v-for="p in notificationData">
                                                <a class="text-body text-decoration-none" :href="'approveorder.php?notif=' + p.transac_id">
                                                    <div class="d-flex">
                                                        <span><img :src="'/uphols/Assets/Images/' + p.product_picture" class="border" style="border-radius: 100px" width="45" height="45"></span><br>
                                                        <div class="ms-3">
                                                            <h5 class="fw-bold mb-1">Admin</h5>
                                                            <p class="mb-3">
                                                                <span>Your order <span class="fw-bold fst-italic">{{ p.productName }}</span> is <span :class="p.transac_status == 1 ? 'text-primary' : 'text-danger' ">{{ p.transac_status == 1 ? 'Approved' : 'Denied' }}</span></span>.
                                                            </p>
                                                            <span class="fs-6 text-muted">
                                                                <span><span class="fa fa-thumbs-up text-success me-1"></span>{{ dateToString(p.created_at) }}</span>
                                                                <span class="ms-1">{{ formattedTime(p.created_at) }}</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="border-top px-3 pt-3 pb-0">
                                    <a href="myorders.php" class="text-link fw-semibold">
                                        See all order
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-link text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img :src="'/Uphols/Assets/Images/'+ cm.profilePicture" alt="hugenerd" width="38" height="38" class="rounded-circle"><br>
                            <div class="">
                                <span class="d-none d-sm-inline mx-1 text-dark text-light text-capitalize">{{ cm.lastname +", " + cm.firstname}}</span><br>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light text-small shadow" aria-labelledby="dropdownUser1">
                            <li>
                                <a class="dropdown-item" href="profile.php">
                                    <div class="col-2 text-center">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-10">Profile</div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="myorders.php">
                                    <div class="col-2 text-center">
                                        <i class="fa fa-truck" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-10">My Services</div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="address.php">
                                    <div class="col-2 text-center">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-10">My Address</div>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutConfirmation" style="cursor: pointer;">
                                    <div class="col-2 text-center">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-10">Logout</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
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