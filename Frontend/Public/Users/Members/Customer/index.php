<?php
session_start();
$pageTitle = $_SESSION['firstname'];
$role = $_SESSION['role'];

if (!isset($_SESSION['user_id'])) {
    if ($role == 1) {
        header("location: /uphols/Frontend/Public/Users/Admin/index.php");
    } else if ($role == 2) {
        header("location: /uphols/Frontend/Public/Users/Members/Employee/index.php");
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
    <title>Upholstery Cordova</title>
    <link rel="stylesheet" href="/uphols/Assets/Css/colors.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/simplebar.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/theme.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/feather.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/slider.css">
    <link rel="stylesheet" href="/uphols/Assets/Plugins/Toastr/toastr.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d41feec2f9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/uphols/Assets/Css/functions.css">
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
    <nav class="navbar navbar-expand-lg navbar-light secondaryColor" id="customer-profile-header">
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
                        <div class="dropdown-menu dropdown-menu-lg-end dropdown-menu-lg" aria-labelledby="dropdownNotification">
                            <div style="width: 350px">
                                <div class="border-bottom px-3 pb-3 d-flex justify-content-between align-items-center">
                                    <span class="h4 mb-0">Notifications Order</span>
                                    <a href="# " class="text-muted">
                                        <span class="align-middle">
                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </div>
                                <ul class="list-group list-group-flush" data-simplebar style="max-height: 300px;">
                                    <li class="list-group-item bg-light">
                                        <div class="row">
                                            <div class="col border-bottom" v-for="p in notificationData">
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
    <div id="customer-index">
        <header>
            <section class="bg-primary">
                <div class="container py-5">
                    <div class="row align-items-center g-0 py-3">
                        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12">
                            <div class="py-7 py-lg-0">
                                <h1 class="text-white display-4 fw-bold">
                                    Villarubia's Upholstery Service and Repair <br>
                                    Repair and Buy
                                </h1>
                                <p class="text-white-50 mb-4 lead">
                                    We pride ourselves on providing excellent customer service, top-quality workmanship, and competitive prices.
                                </p>
                                <a href="requestType.php" class="btn btn-dark col-12 col-lg-6">Request</a>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6 col-md-12 text-lg-end text-center">
                            <img src="/uphols/Assets/Images/indexImage.png" alt="heroimg" class="img-fluid">
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-white py-4 shadow-sm ">
                <div class="container">
                    <div class="row align-items-center g-0">
                        <div class="col-xl-4 col-lg-4 col-md-6 mb-lg-0 mb-4">
                            <div class="d-flex align-items-center">
                                <span class="icon-shape icon-lg bg-light-warning rounded-circle text-center text-dark-warning fs-4 ">
                                    <i class="fe fe-video"> </i></span>
                                <div class="ms-3">
                                    <h4 class="mb-0 fw-semibold">3 Years of business</h4>
                                    <p class="mb-0">Enjoy a variety of fresh furniture</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 mb-lg-0 mb-4">
                            <div class="d-flex align-items-center">
                                <span class="icon-shape icon-lg bg-light-warning rounded-circle text-center text-dark-warning fs-4 ">
                                    <i class="fe fe-users"> </i></span>
                                <div class="ms-3">
                                    <h4 class="mb-0 fw-semibold">Expert Maker</h4>
                                    <p class="mb-0">Right for you</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12">
                            <div class="d-flex align-items-center">
                                <span class="icon-shape icon-lg bg-light-warning rounded-circle text-center text-dark-warning fs-4 ">
                                    <i class="fe fe-clock"> </i></span>
                                <div class="ms-3">
                                    <h4 class="mb-0 fw-semibold">6 Months warranty</h4>
                                    <p class="mb-0">Good warranty</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </header>
        <section>
            <div class="container my-5" v-if="products != 0">
                <header class="mb-4">
                    <h3>Recommended for you</h3>
                </header>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 d-flex" v-for="prod in products">
                        <div class="card w-100 my-2 shadow-2-strong" style="border-radius: 15px;">
                            <a :href="'/uphols/Assets/Images/' + prod.product_picture">
                                <img :src="'/uphols/Assets/Images/' + prod.product_picture" class="img-fluid" style="aspect-ratio: 1 / 1; border-radius: 10px 10px 0 0; width: 30vw" />
                            </a>
                            <div class="card-body text-dark">
                                <div class="px-3">
                                    <h5 class="card-title text-capitalize">{{ prod.productName }}</h5>
                                    <p class="card-text">
                                        <small class="text-secondary">Current Price:</small><br>
                                        &#8369;{{ prod.productPrice }} <br>
                                        <small class="text-secondary">Current Quantity:</small><br>
                                        {{ prod.productQuantity }}
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center g-0 d-flex justify-content-between">
                                    <div class="col-8">
                                        <a @click="showToOrder(prod.product_id)" class="col-12 btn text-start shadow-0 btn-sm" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#buyProduct"><i class="fa fa-shopping-cart text-muted me-1" height="120"></i>Buy</a>
                                    </div>
                                    <div class="col-4">
                                        <a @click="addToCart(prod.product_id)" class="col-12 btn btn-sm shadow-0"><i class="fa fa-heart text-muted me-1" height="120"></i>Cart</a>
                                    </div>
                                </div>
                                <div class="modal" id="buyProduct">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">View Option</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container" v-for="pro in showToBuy">
                                                    <form @submit="buyProduct(pro.product_id)">
                                                        Product Name : {{ pro.productName }} <br>
                                                        Product Price : {{ pro.productPrice }} <br>
                                                        <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantity">
                                                        Select Address
                                                        <select name="address" class="form-control form-control-sm" v-model="role" id="address" required>
                                                            <option value="">Select Address</option>
                                                            <option v-for="(add,index) in customerAddress" :value="add.address_id">{{ add.address_city }}, {{ add.address_barangay }}, {{ add.address_province }}, {{ add.address_zipCode }}</option>
                                                        </select>
                                                        <div class="d-flex justify-content-center align-items-center my-3">
                                                            <button type="submit" class="btn btn-primary mx-3">Buy Product</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-5" style="background-color: #f5f5f5;">
            <div class="container text-dark pt-3">
                <header class="pt-4 pb-3">
                    <h3>Why choose us</h3>
                </header>
                <div class="row mb-4">
                    <div class="col-lg-4 col-md-6">
                        <figure class="d-flex align-items-center mb-4">
                            <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                                <i class="fas fa-camera-retro fa-2x fa-fw text-primary floating"></i>
                            </span>
                            <figcaption class="info">
                                <h6 class="title">Reasonable prices</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmor</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <figure class="d-flex align-items-center mb-4">
                            <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                                <i class="fas fa-star fa-2x fa-fw text-primary floating"></i>
                            </span>
                            <figcaption class="info">
                                <h6 class="title">Best quality</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmor</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <figure class="d-flex align-items-center mb-4">
                            <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                                <i class="fas fa-plane fa-2x fa-fw text-primary floating"></i>
                            </span>
                            <figcaption class="info">
                                <h6 class="title">Worldwide shipping</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmor</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <figure class="d-flex align-items-center mb-4">
                            <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                                <i class="fas fa-users fa-2x fa-fw text-primary floating"></i>
                            </span>
                            <figcaption class="info">
                                <h6 class="title">Customer satisfaction</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmor</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <figure class="d-flex align-items-center mb-4">
                            <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                                <i class="fas fa-thumbs-up fa-2x fa-fw text-primary floating"></i>
                            </span>
                            <figcaption class="info">
                                <h6 class="title">Happy customers</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmor</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <figure class="d-flex align-items-center mb-4">
                            <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                                <i class="fas fa-box fa-2x fa-fw text-primary floating"></i>
                            </span>
                            <figcaption class="info">
                                <h6 class="title">Thousand items</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmor</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-5 mb-4">
            <div class="container text-dark">
                <header class="mb-4">
                    <h3>Blog posts</h3>
                </header>

                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <article>
                            <a href="#" class="img-fluid">
                                <img class="rounded w-100" src="/uphols/Assets/Images/promotePicture.png" style="object-fit: cover;" height="160" />
                            </a>
                            <div class="mt-2 text-muted small d-block mb-1">
                                <span>
                                    <i class="fa fa-calendar-alt fa-sm"></i>
                                    23.12.2022
                                </span>
                                <a href="#">
                                    <h6 class="text-dark">How to promote brands</h6>
                                </a>
                                <p>When you enter into any new area of science, you almost reach</p>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <article>
                            <a href="#" class="img-fluid">
                                <img class="rounded w-100" src="/Uphols/Assets/Images/shipping.png" style="object-fit: cover;" height="160" />
                            </a>
                            <div class="mt-2 text-muted small d-block mb-1">
                                <span>
                                    <i class="fa fa-calendar-alt fa-sm"></i>
                                    13.12.2022
                                </span>
                                <a href="#">
                                    <h6 class="text-dark">How we handle shipping</h6>
                                </a>
                                <p>When you enter into any new area of science, you almost reach</p>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <article>
                            <a href="#" class="img-fluid">
                                <img class="rounded w-100" src="/uphols/Assets/Images/promotePicture2.png" style="object-fit: cover;" height="160" />
                            </a>
                            <div class="mt-2 text-muted small d-block mb-1">
                                <span>
                                    <i class="fa fa-calendar-alt fa-sm"></i>
                                    25.11.2022
                                </span>
                                <a href="#">
                                    <h6 class="text-dark">How to promote brands</h6>
                                </a>
                                <p>When you enter into any new area of science, you almost reach</p>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <article>
                            <a href="#" class="img-fluid">
                                <img class="rounded w-100" src="/uphols/Assets/Images/successstory.png" style="object-fit: cover;" height="160" />
                            </a>
                            <div class="mt-2 text-muted small d-block mb-1">
                                <span>
                                    <i class="fa fa-calendar-alt fa-sm"></i>
                                    03.09.2022
                                </span>
                                <a href="#">
                                    <h6 class="text-dark">Success story of sellers</h6>
                                </a>
                                <p>When you enter into any new area of science, you almost reach</p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <?php
        include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/footerLink.php');
        ?>
    </div>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerFooter.php');
    ?>