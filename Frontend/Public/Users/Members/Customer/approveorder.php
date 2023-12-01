<?php
session_start();
$pageTitle = "My Carts";

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerHeader.php');
?>
<div class="my-5 py-2"></div>
<section class="container-fluid py-5" id="customer-profile">
    <div class="row justify-content-center" v-for="or of OrderNofitication">
        <div class="col-lg-8 col-12" >
            <div class="card">
                <div class="card-body">
                    <div class="mb-6">
                        <h2 class="mb-0">Thank you for your order</h2>
                        <p class="mb-0">We appreciate your order, were currently processing it. So hard tight and we will send
                            you confirmation very soon!</p>
                    </div>
                    <div>
                        <div class="border-bottom mb-3 pb-3 ">
                            <div class="d-flex align-items-center">
                                <h4 class="mb-0">Order tracking number</h4>
                                <a href="#" class="ms-2 fw-semibold">{{or.transac_id}}</a>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-lg-8 col-12">
                                <div class="d-md-flex">
                                    <div>
                                        <img :src="'/uphols/Assets/images/'+or.product_picture" alt="" class="img-4by3-xl rounded">
                                    </div>
                                    <div class="ms-md-4 mt-2">
                                        <h5 class="mb-1">
                                            {{or.productName}}
                                        </h5>
                                        <!-- <span>Color: <span class="text-dark">Orange</span>, Size:<span class="text-dark"> 10</span> -->
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="d-flex justify-content-end mt-2">
                                    <h5>{{or.productPrice}}</h5>
                                </div>
                            </div>
                        </div>
                        <div>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <span class="text-dark fw-medium">{{or.productPrice}}</span>
                                </li>
                                <li class="d-flex justify-content-between mb-2">
                                    <span>Order Quantity</span>
                                    <span class="text-dark fw-medium">{{or.transac_quantity}}</span>
                                </li>
                                <li class="border-top my-2"></li>
                                <li class="d-flex justify-content-between mb-2">
                                    <span class="fw-medium text-dark">Grand Total</span>
                                    <span class="fw-medium text-dark">{{or.transac_quantity * or.productPrice}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4" :class="or.transac_status == 1 ? '' : 'visually-hidden'">
                <div class="card-body">
                    <div class="mb-4">
                        <h2 class="mb-0">Your Order is <span class="text-primary">Approved</span> and being shipped to</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <h4>Shipping Address</h4>
                            <p>
                                {{or.address_street}}<br>
                                {{or.address_province}}, {{or.address_city}}<br>
                                {{or.address_barangay}} - {{or.address_zipCode}},<br>
                                {{or.address_region}}<br>
                            </p>
                            <p class="mb-0">Email: {{or.email}}</p>
                            <p class="mb-0">Phone: 0{{or.phone}}</p>
                        </div>
                        <div class="col-md-6 col-12">
                            <h4 class="mb-3">Payment Method</h4>
                            <p class="mb-0">COD</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4" :class="or.transac_status != 1 ? '' : 'visually-hidden'">
                <div class="card-body">
                    <div class="mb-4">
                        <h2 class="mb-0">Your Order is <span class="text-danger">Denied</span></h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <h4>Shipping Address</h4>
                            <p>
                                None<br>
                                None, None<br>
                                None - None,<br>
                                None<br>
                            </p>
                            <p class="mb-0">Email: {{or.email}}</p>
                            <p class="mb-0">Phone: 0{{or.phone}}</p>
                        </div>
                        <div class="col-md-6 col-12">
                            <h4 class="mb-3">Payment Method</h4>
                            <p class="mb-0">None</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/footerLink.php');
    ?>
</section>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerFooter.php');
?>