<?php
session_start();
$pageTitle = $_SESSION['firstname'];

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/adminFullNav.php');
?>
<div class="container-fluid p-0" id="order-admin">
    <section class="content-header">
        <div class="content-header my-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0 fw-bold">Invoice</h1>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb my-auto">
                            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-dark">Home</a></li>
                            <li class="breadcrumb-item active text-dark" aria-current="page">Invoice</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="row overflow-auto">
        <div class="col-md-12">
            <div class="InvoiceMother">
                <div class="invoice">
                    <div class="row px-5 pb-3">
                        <div class="col-12 d-flex justify-content-between">
                            <div class="logo"><img src="/uphols/Assets/Images/mainLogo.png" alt="UpholsteryLogo" class="rounded" width="130"></div>
                        </div>
                        <div class="col-4 border-end">
                            <br><b>From</b><br><br>
                            <b>Villarubia's Uphosltery</b> <br>
                            Bangbang Cordova
                            Cebu 6017<br>
                            Phone: 0912345456<br>
                            Email: inocgeorge@gmail.com
                        </div>
                        <div class="col-4 border-end">
                            <br><b>To</b><br><br>
                            <b>{{ lastname }}, {{ firstname }}</b> <br>
                            {{ address_city +", "+ address_barangay +", "+ address_province }}<br>
                            {{ address_street +", "+ address_zipCode }}<br>
                            Phone: 0{{ phone }}<br>
                            Email: {{ email }}
                        </div>
                        <div class="col-4">
                            <br><b>Where</b><br><br>
                            <div class="my-auto">
                                <b>Delivery Date: </b> {{ date_delivery }} <br>
                                <b>Deliver Status: </b> {{ transac_status == 1 ? 'To be Deliver' : 'Delivered' }} <br>
                                <b>Total Payment: </b>&#8369;{{ totalInvoicePrice }}
                            </div>
                        </div>
                        <div class="col-12 mt-1">
                            <div class="table bordermy-sm-3">
                                <table class="table border">
                                    <thead class="text-center border">
                                        <tr>
                                            <th></th>
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr v-for="or in selectedOrder" :class="or.order_status == 1 ? 'text-center' : or.order_status == 2 ? 'text-center' : 'bg-white text-center'">
                                            <td class="text-center"><input type="checkbox" v-model="selectedItem" @change="storeAllSelectedOrder(selectedItem)" name="selectedItem" id="selectedItem" :value="or.id" :disabled="or.order_status !== 3" checked></td>
                                            <td><img :src="'/uphols/Assets/Images/' + or.product_picture" width="40" class="rounded" alt=""></td>
                                            <td>{{ or.productName }}</td>
                                            <td>{{ or.order_quantity }}</td>
                                            <td>{{ or.productPrice }}</td>
                                            <td>{{ or.productPrice * or.order_quantity }}</td>
                                            <td :class="or.order_status == 1 ? 'text-primary' : or.order_status == 2 ? 'text-danger' : 'text-warning'">{{ or.order_status == 1 ? 'Approved' : or.order_status == 2 ? 'Declined/Cancelled' : 'Pending'}}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm text-active mx-1" @click="getUpdateQuantityInApproval(or.id,1, or.customer_id, email)" :disabled="or.order_status != 3">Approve</button>
                                                <button type="button" class="btn btn-sm text-inactive mx-1" @click="getUpdateQuantityInApproval(or.id,2, or.customer_id, email)" :disabled="or.order_status != 3">Decline</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="btnApprove">
                            <button type="button" class="btn btn-primary col-2 btn-sm float-end" @click="getAllApproveCustomersOrder(email)" :disabled="selectedItem.length === 0">Approve All</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/AdminFooter.php');
?>