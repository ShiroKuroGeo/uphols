<?php
session_start();
$pageTitle = $_SESSION['firstname'];

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/adminFullNav.php');
?>
<style>
    .newPrimary {
        color: #139a74;
    }
</style>
<section class="container-fluid p-4" id="request-admin">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page Header -->
            <div class="border-bottom pb-3 mb-3 d-flex justify-content-between align-items-center">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-1 h2 fw-bold">
                        Requests
                        <span class="fs-5 text-muted">({{ request.length }})</span>
                    </h1>
                    <!-- Breadcrumb  -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../index.php" class="newPrimary">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!" class="newPrimary">Requests</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Request
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 mb-3">
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
                        <canvas id="requestChart" class="col-12" style="height: 100%"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="mb-0">Users Request</h4>
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
                            <tr v-for="req in request">
                                <td class="fs-5 text-capitalize">{{req.lastname}}, {{req.firstname}}</td>
                                <td>
                                    <div>
                                        {{ req.status == 5 ? 'Delivered' : req.status == 2 ? 'Approved' : req.status == 3 ? 'Scheduled' : req.status == 4 ? 'Deliver' : 'Pending' }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a :href="'invoice.php?invoice='+ req.id" :class="req.status == 5 ? 'visually-hidden' : '' ">
                                        <button type="button" class="btn btn-primary btn-sm">Invoice</button>
                                    </a>
                                    <a :href="'sendRequest.php?invoice='+ req.id" :class="req.status != 5 ? 'visually-hidden' : '' ">
                                        <button type="button" class="btn btn-primary btn-sm">Send Schedule</button>
                                    </a>
                                </td>
                            </tr>
                            <tr v-if="request == 0">
                                <td class="text-capitalize">No Data</td>
                                <td>
                                    No Data
                                </td>
                                <td class="text-center">
                                    No Data
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/AdminFooter.php');
?>