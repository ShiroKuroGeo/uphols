<?php
session_start();
$pageTitle = "Request Form";

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerHeader.php');
?>

<!-- Start of the content -->
<section class="py-5 vh-100 " id="customer-Request">
    <div class="py-6">
        <div class="row">
            <div class="offset-xl-3 col-xl-6 col-md-12 col-12">
                <div class="card">
                    <div class="card-body p-lg-6">
                        <h4 class="text-center fw-bold fs-2 mb-3">Customize Project Form</h4>
                        <form class="row gx-3" @submit="storeRequest">
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Types</label>
                                <select class="selectpicker form-control text-capitalize" v-model="selectedType" name="Types" data-width="100%">
                                    <option value="selected">Select Types</option>
                                    <option v-for="d in design" :value="d.Types">&#8369;{{d.typePrice}} - {{d.Types}}</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Color</label>
                                <select class="selectpicker form-control text-capitalize" v-model="selectedColor" name="Color" data-width="100%">
                                    <option value="selected">Select Color</option>
                                    <option v-for="d in design" :value="d.Color">&#8369;{{d.colorPrice}} - {{d.Color}}</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Fabric</label>
                                <select class="selectpicker form-control text-capitalize" v-model="selectedFabric" name="Fabric" data-width="100%">
                                    <option value="selected">Select Fabics</option>
                                    <option v-for="d in design" :value="d.fabric">&#8369;{{d.fabricPrice}} - {{d.fabric}}</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Address</label>
                                <select class="selectpicker form-control text-capitalize" name="Address" data-width="100%">
                                    <option selected>Select Address </option>
                                    <option v-for="ca of customerAddress" :value="ca.address_id">{{ ca.address_province + ", " + ca.address_city + ", " + ca.address_barangay + ", " + ca.address_street}}</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Payment Method</label>
                                <select class="selectpicker form-control" name="paymentMethod" data-width="100%">
                                    <option value="OTHER">Gcash, ETC.</option>
                                </select>
                            </div>
                            <div class="mb-3 col-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="Message" placeholder="Enter brief about project..." rows="3"></textarea>
                            </div>
                            <div class="col-md-8"></div>
                            <div class="col-12">
                                <div class="float-start fw-bold text-dark my-auto">
                                    <select class="form-control" v-model="totalCheque" @change="totalChequePayment">
                                        <option value="0">Selected Pay: &#8369;{{ cheque }}</option>
                                        <option :value="chequeDown">Down Payment: &#8369;{{ chequeDown }}</option>
                                        <option :value="cheque">Whole Payment &#8369;{{ cheque }}</option>
                                    </select>
                                </div>
                                <div class="buttons float-end">
                                    <button class="btn btn-primary" type="submit" :disabled="totalCheque == 0">Submit</button>
                                    <button type="button" class="btn btn-outline-primary ms-2 " data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/footerLink.php');
    ?>
</section>

<!-- End of the content -->

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerFooter.php');
?>