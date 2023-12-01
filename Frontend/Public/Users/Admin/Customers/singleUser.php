<?php
session_start();
$pageTitle = $_SESSION['firstname'];

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/adminFullNav.php');
?>
<section class="container-fluid p-4" id="customer-admin">
    <div class="row" v-for="user in selectedUser">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold text-capitalize">{{ user.lastname + ", " + user.firstname}}</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../index.php">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Single User</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ user.lastname + ", " + user.firstname}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row" v-for="user in selectedUser">
        <div class="col-lg-8 col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <img :src="'/uphols/Assets/Images/' + user.profilePicture" class="avatar-xl rounded-circle" alt="">
                        <div class="ms-4">
                            <h3 class="mb-1 text-capitalize">{{ user.lastname + ", " + user.firstname}}</h3>
                            <h3 class="text-muted fs-6 text-capitalize">Username: {{ user.username }}</h3>
                            <h3 class="text-muted fs-6 text-capitalize">Code: {{ user.code }}</h3>
                            <div>
                                <span><i class="fa fa-calendar me-2" aria-hidden="true"></i>Customer since {{ dateToString(user.created_at) }} </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mb-4 col-6">
                    <div class="card">
                        <!-- card body -->
                        <div class="card-header">
                            <h4 class="mb-0">Recent Order ({{selectedCustomerOrder.length}})</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush" v-for="c of selectedCustomerOrder">
                                <li class="list-group-item px-0">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <h6 class="text-primary mb-0">Order ID: {{c.id}}</h6>
                                            </div>
                                            <div>
                                                <span>{{dateToString(c.created)}}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <a href="#" class="text-inherit">
                                                    <div class="d-lg-flex align-items-center">
                                                        <div>
                                                            <img :src="'/uphols/Assets/Images/'+ c.product_picture" alt="" class="img-4by3-md rounded">
                                                        </div>
                                                        <div class="ms-lg-3 mt-2 mt-lg-0">
                                                            <h5 class="mb-0">
                                                                {{c.productName}}
                                                            </h5>
                                                            <span class="fs-6">Quantity: {{c.order_quantity}}</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-6">
                    <div class="card">
                        <!-- card body -->
                        <div class="card-header">
                            <h4 class="mb-0">Recent Carts ({{selectedUserCart.length}})</h4>
                        </div>
                        <div class="card-body">

                            <ul class="list-group list-group-flush" v-for="c of selectedUserCart">
                                <li class="list-group-item px-0">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <h6 class="text-primary mb-0">Order ID: {{c.cart_id}}</h6>
                                            </div>
                                            <div>
                                                <span>{{ dateToString(c.created) }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <a href="#" class="text-inherit">
                                                    <div class="d-lg-flex align-items-center">
                                                        <div>
                                                            <img :src="'/uphols/assets/images/'+c.product_picture" alt="" class="img-4by3-md rounded">
                                                        </div>
                                                        <div class="ms-lg-3 mt-2 mt-lg-0">
                                                            <h5 class="mb-0">
                                                                {{c.productName}}
                                                            </h5>
                                                            <span class="fs-6">Quantity: {{c.quantityCart}}</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <!-- card -->
            <div class="card mt-4 mt-lg-0">
                <div class="card-body border-bottom">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Contact</h4>
                    </div>
                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa fa-envelope text-muted fs-4"></i><a href="#" class="ms-1">{{user.email}}</a>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa fa-mobile text-muted fs-4"></i><span class="ms-2">0{{user.phone}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/AdminFooter.php');
?>