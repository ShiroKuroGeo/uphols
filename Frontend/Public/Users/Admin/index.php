<?php
session_start();
$pageTitle = $_SESSION['firstname'];

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/adminFullNav.php');
?>

<section class="container-fluid p-4" id="Dashboard-admin">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                        <div>
                                            <span class="fs-6 text-uppercase fw-semibold">Members</span>
                                        </div>
                                        <div>
                                            <span class="p-1 me-2 "><a href="Customers/index.php" class="text-light"><i class="fa-solid fa-users fa-2x" style="color: #023047;"></i></a></span>
                                        </div>
                                    </div>
                                    <h2 class="fw-bold mb-1">
                                        {{ customerLength }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                        <div>
                                            <span class="fs-6 text-uppercase fw-semibold">Products</span>
                                        </div>
                                        <div>
                                            <span class="p-1 me-2 "><a href="Products/index.php" class="text-light"><i class="fa-solid fa-box-open fa-2x" style="color: #139a74"></i></a></span>
                                        </div>
                                    </div>
                                    <h2 class="fw-bold mb-1">
                                        {{ productLength }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                        <div>
                                            <span class="fs-6 text-uppercase fw-semibold">Orders</span>
                                        </div>
                                        <div>
                                            <span class="p-1 me-2 "><a href="Orders/index.php" class="text-light"><i class="fa-solid fa-arrow-trend-up fa-2x" style="color: #139a74"></i></a></span>
                                        </div>
                                    </div>
                                    <h2 class="fw-bold mb-1">
                                        {{ ordersLength }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                        <div>
                                            <span class="fs-6 text-uppercase fw-semibold">Recommend</span>
                                        </div>
                                        <div>
                                            <span class="p-1 me-2 "><a href="Recommendation/index.php" class="text-light"><i class="fa-solid fa-comments fa-2x" style="color: #139a74"></i></a></span>
                                        </div>
                                    </div>
                                    <h2 class="fw-bold mb-1">
                                        {{ recommendationLength }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-4">
                            <div class="card mb-4">
                                <div class="card-header align-items-center card-header-height">
                                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                        <div class="">
                                            <h4 class="mb-0">Sales</h4>
                                        </div>
                                        <div class="">
                                            <i class="far fa-chart-bar fa-2x" style="color: #139a74"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body d-flex justify-content-center align-items-center ">
                                    <canvas id="indexChart" class="col-12" style="max-width: 680px; max-height: 250px"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-12 mb-4">
                            <div class="card h-100">
                                <div class="card-header d-flex align-items-center justify-content-between card-header-height">
                                    <h4 class="mb-0">Latest Members</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0 mb-3" v-for="cus in customers">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <div class="avatar avatar-md avatar-indicators avatar-offline">
                                                        <img :src="'/uphols/Assets/Images/' + cus.profilePicture" width="40" height="40" class="rounded" alt="User Image">
                                                    </div>
                                                </div>
                                                <div class="col ">
                                                    <h4 class="h5 text-capitalize">{{ cus.lastname }}, {{ cus.firstname }}</h4>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-12 mb-4">
                            <div class="card h-100">
                                <div class="card-header d-flex align-items-center justify-content-between card-header-height">
                                    <h4 class="mb-0">Latest Products</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0 mb-3" v-for="pro in products">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <div class="avatar avatar-md avatar-indicators avatar-offline">
                                                        <img :src="'/uphols/Assets/Images/' + pro.product_picture" width="40" height="40" class="rounded" alt="User Image">
                                                    </div>
                                                </div>
                                                <div class="col ">
                                                    <h4 class="h5 text-capitalize">{{ pro.productName }}</h4>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-4">
                            <div class="card mb-4">
                                <div class="card-header align-items-center card-header-height">
                                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                        <div class="">
                                            <h4 class="mb-0">Calendar Delivery Date</h4>
                                        </div>
                                        <div class="">
                                            <i class="far fa-calendar fa-2x" style="color: #023047;"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/AdminFooter.php');
?>