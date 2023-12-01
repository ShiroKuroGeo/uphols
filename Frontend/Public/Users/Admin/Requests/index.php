<?php
session_start();
$pageTitle = $_SESSION['firstname'];

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/adminFullNav.php');
?>
<section class="container-fluid p-4" id="request-admin">
    <div class="row">
        <div class="col-lg-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="mb-3">Request Record</h4>
                    <canvas id="requestChart" class="col-" style="height: 100px; width: 100px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="mb-0">Users Request</h4>
                </div>
                <div class="table-responsive" data-simplebar style="height: 70vh; overflow: auto;">
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