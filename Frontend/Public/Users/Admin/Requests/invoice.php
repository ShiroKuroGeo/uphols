<?php
session_start();
$pageTitle = $_SESSION['firstname'];

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/adminFullNav.php');
?>

<div class="container-fluid p-0" id="request-admin">
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

    <main class="row overflow-auto" v-for="(req,index) in allInfoRequest">
        <div class="col-md-12">
            <div class="InvoiceMother">
                <div class="invoice">
                    <div class="row px-5 pb-3">
                        <div class="col-12 mb-3 d-flex justify-content-between">
                            <div class="logo">
                                <img src="/uphols/Assets/Images/mainLogo.png" alt="UpholsteryLogo" class="rounded" width="130">
                            </div>
                        </div>
                        <div class="col-4 border ">
                            <br><b>From</b><br><br>
                            <b>Villarubia's Uphosltery</b> <br>
                            Bangbang Cordova <br>
                            Cebu 6017<br>
                            Phone: 0912345456<br>
                            Email: inocgeorge@gmail.com
                        </div>
                        <div class="col-4 border ">
                            <br><b>To</b><br><br>
                            <b class="text-capitalize">{{ req.lastname }}, {{ req.firstname }}</b> <br>
                            {{ req.address_city +", "+ req.address_barangay +", "+ req.address_province }}<br>
                            {{ req.address_street +", "+ req.address_zipCode }}<br>
                            Phone: 0{{ req.phone }}<br>
                            Email: {{ req.email }}
                        </div>
                        <div class="col-4 border">
                            <br><b>What</b><br><br>
                            <div class="my-auto">
                                <b>Request Date: </b>{{ dateCreated }}<br>
                                <b>Delivery Date: </b>{{dateDeliver}}<br>
                                <b>Request Status: </b>{{ req.status == 1 ? 'Repairing' : req.status == 2 ? 'Done' : req.status == 3 ? 'Delivered' : 'Pending' }}<br>
                                <b>Request Form: </b><span @click="viewMyRequest" class="text-primary" style="cursor: pointer;">View My Request</span><br>
                                <b>Payment Method: </b>{{req.paymentMethod}}
                            </div>
                        </div>
                        <div v-if="isShown" class="fw-bolder col-12 border px-5 py-3 mt-1">
                            <table class="table border">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">{{ 1 + index++}}</th>
                                        <td>{{req.Types}}</td>
                                        <td>{{req.color}}</td>
                                        <td>
                                            <span class="text-primary" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#messageModal">
                                                Show Message
                                            </span>
                                            <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-center">
                                                            <div class="col-8 text-center">
                                                                {{req.message}}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-info col-5" data-bs-dismiss="modal">Okay</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="alert alert-danger visually-hidden" id="errorAlert" role="alert">
                                                Select Status
                                            </div>
                                            <select v-model="selectStatusOption" class="form-control form-control-sm">
                                                <option value="0">{{ req.status == 5 ? 'Delivered' : req.status == 2 ? 'Approved' : req.status == 3 ? 'Scheduled' : req.status == 4 ? 'Deliver' : 'Pending' }}</option>
                                                <option value="2" :disabled="selectStatusOption == 3">Mark as Approve</option>
                                                <option value="3" :disabled="selectStatusOption == 2">Mark as Schedule</option>
                                                <option value="4" :disabled="selectStatusOption == 5">Mark as Deliver</option>
                                                <option value="5" :disabled="selectStatusOption == 4">Mark as Delivered</option>
                                            </select>
                                            <input type="date" v-model="dateDeliver" :class="selectStatusOption == 3 ? 'form-control form-control-sm' : 'form-control form-control-sm visually-hidden'">
                                            <button @click="updateStatus(req.id, req.email)" class="btn btn-sm btn-primary mt-2 col-12">Update</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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