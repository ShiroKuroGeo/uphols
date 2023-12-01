<?php
session_start();
$pageTitle = $_SESSION['firstname'];

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/adminFullNav.php');
?>
<div id="order-admin" class="p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page Header -->
            <div class="border-bottom pb-3 mb-3 d-flex justify-content-between align-items-center">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-1 h2 fw-bold">
                        Orders
                        <span class="fs-5 text-muted">({{ order.length }})</span>
                    </h1>
                    <!-- Breadcrumb  -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../index.php">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Orders
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="card panel-shadow h-100">
                    <div class="card col-12 h-100">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Order Record</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body col-12 d-flex justify-content-center border">
                            <canvas id="orderChart" class="col-12" style="height: 100%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="mb-0">Users Orders</h4>
                    </div>
                    <div class="table-responsive" data-simplebar style="height: 50vh; overflow: auto;">
                        <table class="table text-nowrap mb-0 table-centered table-hover">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th>Customer Requesters Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="or in order">
                                    <td class="text-capitalize">{{ or.lastname }}, {{ or.firstname }}</td>
                                    <td>
                                        <div :class="or.order_status == 1 ? 'text-primary rounded text-center col-5' : or.status == 2 ? 'text-warning rounded text-center col-5' : 'text-danger rounded text-center col-5' ">
                                            {{ or.order_status !== 3 ? 'Checked' : 'Ready to Check' }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a :href="'invoice.php?invoice=' + or.customer_id">
                                            <button type="button" class="btn btn-primary btn-sm">Invoice</button>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/AdminFooter.php');
?>