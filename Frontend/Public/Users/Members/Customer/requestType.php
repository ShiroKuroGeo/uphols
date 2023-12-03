<?php
session_start();
$pageTitle = "Request Form";

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerHeader.php');
?>

<main id="customer-Request">
    <section class="py-lg-13 py-8 bg-primary">
        <div class="container">
            <!-- Page header -->
            <div class="row align-items-center">
                <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-12">
                    <div class="text-center mb-6 px-md-8">
                        <h1 class="text-white display-3 fw-bold">
                            Furniture enhances comfort and functionality.
                        </h1>
                        <p class="text-white lead mb-4">
                            Furniture customization tailors pieces to individual preferences,
                            while repair restores damaged items to their original condition.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Content -->
    <section class="mt-n8 pb-8">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-4 col-md-12 col-12">
                    <!-- Card -->
                    <div class="card border-0 mb-3">
                        <!-- Card body -->
                        <div class="p-5 text-center">
                            <img src="/uphols/assets/Images/mainLogo.png" alt="icon" class="card-img w-100">
                            <div class="mb-5">
                                <h2 class="fw-bold">Customize</h2>
                                <p class="mb-0">
                                    Customized furniture
                                    <span class="text-dark fw-medium">is tailor-made to individual preferences and requirements.</span>
                                </p>
                            </div>
                            <div class="d-flex justify-content-center mb-4">
                                <span class="h3 mb-0 fw-bold">&#8369;</span>
                                <div class=" toggle-price-content odometer h1" data-price-monthly="0" data-price-yearly="0">
                                    2000
                                </div>
                                <span class="align-self-end mb-1 ms-2 toggle-price-content">/Item</span>
                            </div>
                            <div class="d-grid">
                                <a href="request.php" class="btn btn-outline-primary">Customize Design Request</a>
                            </div>
                        </div>
                        <hr class="m-0">
                        <div class="p-5">
                            <h4 class="fw-bold mb-4">
                                All core features, including:
                            </h4>
                            <!-- List -->
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1">
                                    <span class="text-success me-1"><i class="mdi mdi-check-circle-outline fs-4"></i></span>
                                    <span>Cebu Area Only</span>
                                </li>
                                <li class="mb-1">
                                    <span class="text-success me-1"><i class="mdi mdi-check-circle-outline fs-4"></i></span>
                                    <span>Can Choose what design</span>
                                </li>
                                <li class="mb-1">
                                    <span class="text-success me-1"><i class="mdi mdi-check-circle-outline fs-4"></i></span>
                                    <span>Free Delivery</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12">
                    <!-- Card -->
                    <div class="card border-0 mb-3 mb-lg-0">
                        <!-- Card body -->
                        <div class="p-5 text-center">
                            <img src="/uphols/assets/Images/mainLogo.png" alt="icon" class="card-img w-100">
                            <div class="mb-5">
                                <h2 class="fw-bold">Repair</h2>
                                <p class="mb-0">
                                    Furniture repair
                                    <span class="text-dark fw-medium">restores damaged pieces to functional condition.</span>
                                </p>
                            </div>
                            <div class="d-flex justify-content-center mb-4">
                                <div class="toggle-price-content odometer h1" data-price-monthly="39" data-price-yearly="99">
                                    Free
                                </div>
                            </div>
                            <div class="d-grid">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#schedule">Schedule Repair Request</a>
                                <div class="modal fade" id="schedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Schedule Sent</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-0 mx-5 mt-5">
                                                <div class="group">
                                                    <div class="float-start text-dark fw-bold">Select Address</div>
                                                    <select class="selectpicker form-control text-capitalize" v-model="addressSelected" data-width="100%">
                                                        <option value="0">Select Address</option>
                                                        <option v-for="ca of customerAddress" :value="ca.address_id">{{ ca.address_province + ", " + ca.address_city + ", " + ca.address_barangay + ", " + ca.address_street}}</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 mt-5 float-bottom"><span class='text-danger'>Note:</span> You will recieve your date schedule on your notification anytime this day, please wait until tommorrow morning.</div><br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" @click="scheduleRepair">Okay</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="m-0">
                        <div class="p-5">
                            <h4 class="fw-bold mb-4">
                                Everything in Starter, plus:
                            </h4>
                            <!-- List -->
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1">
                                    <span class="text-success me-1"><i class="mdi mdi-check-circle-outline fs-4"></i></span>
                                    <span>Cebu Area Only</span>
                                </li>
                                <li class="mb-1">
                                    <span class="text-success me-1"><i class="mdi mdi-check-circle-outline fs-4"></i></span>
                                    <span>Will take your things to be repaired</span>
                                </li>
                                <li class="mb-1">
                                    <span class="text-success me-1"><i class="mdi mdi-check-circle-outline fs-4"></i></span>
                                    <span>Free Delivery</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerFooter.php');
?>