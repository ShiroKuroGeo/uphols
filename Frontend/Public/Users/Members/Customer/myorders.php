<?php
session_start();
$pageTitle = "My Orders";

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerHeader.php');
?>

<style>
    ::-webkit-scrollbar {
        width: 10px;
        background: #555;
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 5px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
<div class="my-3"><br></div>
<section class="vh-100 bg-light" id="customer-Order">
    <section class="container p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Card -->
                <div class="rounded-3">
                    <!-- Card Header -->
                    <div class="border mb-1 shadow bg-white">
                        <div class="border-bottom-0 p-0">
                            <!-- nav -->
                            <ul class="nav nav-lb-tab" id="tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="all-orders-tab" data-bs-toggle="pill" href="#all-orders" role="tab" aria-controls="all-orders" aria-selected="true">All My Orders</a>
                                </li>
                            </ul>
                        </div>
                        <div class="p-4 row gx-3">
                            <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                                <form class="d-flex align-items-center">
                                    <span class="position-absolute ps-3 search-icon">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="search" class="form-control ps-5" v-model="searchOrderNow" placeholder="Search Product">
                                </form>
                            </div>
                            <div class="col-6 col-lg-3">
                                <select class="form-select" v-model="selectedSort">
                                    <option selected>Ordered</option>
                                    <option value="1">My Orders</option>
                                    <option value="2">My Request</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="tab-content bg-white" id="tabContent">
                            <div class="tab-pane fade show active shadow" id="all-orders" role="tabpanel" aria-labelledby="all-orders-tab">
                                <div class="table-responsive" style="height: 400px; overflow-y: scroll;">
                                    <table class="table mb-0 text-nowrap table-hover table-centered mx-0" v-if="selectedSort == 1">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Order Picture</th>
                                                <th>Purchased</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Revenue</th>
                                                <th>Order Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="orders in searchOrder" class="border">
                                                <td width="20%">
                                                    <a :href="'/uphols/Assets/Images/' + orders.product_picture" class="text-decoration-none ps-3">
                                                        View Image
                                                    </a>
                                                </td>
                                                <td width="16%">
                                                    {{ orders.productName }}
                                                </td>
                                                <td width="13%">
                                                    {{ orders.order_quantity }}
                                                </td>
                                                <td width="10%">
                                                    {{ orders.productPrice }}
                                                </td>
                                                <td width="12%">
                                                    {{ orders.productPrice * orders.order_quantity }}
                                                </td>
                                                <td width="15%">
                                                    <span :class="orders.order_status == 1 ? 'badge text-primary bg-light-primary' : orders.order_status == 2 ? 'badge text-warning bg-light-warning' : orders.order_status == 3 ? 'badge text-danger bg-light-danger' : 'badge text-dark bg-light-dark'">{{ orders.order_status == 1 ? 'Approve / Schedule On Deliver' : orders.order_status == 2 ? 'Decline / Cancelled' : orders.order_status == 3 ? 'Pending / On Scheduled' : 'Request Cancel' }}</span><br>
                                                </td>
                                                <td class="text-center">
                                                    <span class="dropdown">
                                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                        </a>
                                                        <span class="dropdown-menu" aria-labelledby="orderDropdownOne">
                                                            <button :class="orders.order_status == 3 ? 'btn btn-sm col-12' : 'visually-hidden'" @click="requestCancel(orders.id)">Request Cancel</button>
                                                            <button :class="orders.order_status == 4 ? 'btn btn-sm col-12' : 'visually-hidden'" @click="backToPending(orders.id)">Back to Pending</button>
                                                            <button :class="orders.order_status == 1 ? 'btn btn-sm col-12' : 'visually-hidden'">This item is Approved already.</button>
                                                            <button :class="orders.order_status == 2 ? 'btn btn-sm col-12' : 'visually-hidden'">I'm sorry this item is decline.</button>
                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table mb-0 text-nowrap table-hover table-centered mx-0" v-if="selectedSort == 2">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Types</th>
                                                <th>Color</th>
                                                <th>Message</th>
                                                <th>Payment Method</th>
                                                <th>Status</th>
                                                <th>Requested at</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="req in searchRequest" class="border">
                                                <td width="16%">
                                                    {{ req.Types == '' ? 'On Schedule' : req.Types }}
                                                </td>
                                                <td width="16%">
                                                    {{ req.color == '' ? 'On Schedule' : req.color}}
                                                </td>
                                                <td width="13%">
                                                    <a href="#!" data-bs-toggle="modal" data-bs-target="#readMyMessage" @click="viewMessage(req.id)">View Message</a>
                                                    <div class="modal fade" id="viewDateToBeDeliveredMyOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Date to be Deliver</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <span :class="dateDeliver == '' ? 'visually-hidden' : ''">On {{ dateToString(dateDeliver) }}</span>
                                                                    <span :class="dateDeliver != '' ? 'visually-hidden' : ''">Wait for the schedule.</span>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary btn-md" data-bs-dismiss="modal">Okay</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="readMyMessage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">View My Message</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {{ readMessage == '' ? 'On Schedule' : readMessage }}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary btn-md" data-bs-dismiss="modal">Okay</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td width="10%">
                                                    {{ req.paymentMethod == '' ? 'On Schedule' : req.paymentMethod}}
                                                </td>
                                                <td width="15%">
                                                    <span :class="req.status == 1 ? 'badge text-primary bg-light-primary' : req.status == 2 ? 'badge text-info bg-light-info' : req.status == 5 ? 'badge text-danger bg-light-danger' : 'badge text-dark bg-light-dark'">{{ req.status == 1 ? 'Pending Repair / Approve' : req.status == 2 ? 'Repaired / Schedule on' : req.status == 5 ? 'Schedule is at task' : 'Request Cancel' }}</span><br>
                                                </td>
                                                <td width="10%">
                                                    {{ dateToString(req.created_at) }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="#!" data-bs-toggle="modal" data-bs-target="#viewDateToBeDelivered" @click="viewDateDelivery(req.id)">View Deliver Date</a>
                                                    <div class="modal fade" id="viewDateToBeDelivered" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Date to be Deliver</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <span :class="dateDeliver == '' ? 'visually-hidden' : ''">On {{ dateToString(dateDeliver) }}</span>
                                                                    <span :class="dateDeliver != '' ? 'visually-hidden' : ''">Wait for the schedule.</span>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary btn-md" data-bs-dismiss="modal">Okay</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/footerLink.php');
    ?>
    <!-- End of the content -->

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerFooter.php');
    ?>