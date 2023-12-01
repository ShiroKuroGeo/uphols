<?php
session_start();
$pageTitle = $_SESSION['firstname'];

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/adminFullNav.php');
?>

<div class="container-fluid p-0" id="request-admin">
    <main class="row overflow-auto">
        <div class="col-md-12">
            <div class="py-6">
                <div class="row">
                    <div class="offset-xl-3 col-xl-7 col-md-12 col-12">
                        <div class="card">
                            <div class="card-body p-lg-6">
                                <h4 class="text-center fw-bold fs-2 mb-5">Customize Project Form</h4>

                                <form class="row gx-3" @submit="storeRequest">
                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Types</label>
                                        <input type="text" class="selectpicker form-control text-capitalize" name="Types" placeholder="Enter kind of Type" required>
                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Color</label>
                                        <input type="text" class="selectpicker form-control text-capitalize" name="Color" placeholder="Enter kind of Color" required>
                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Fabric</label>
                                        <input type="text" class="selectpicker form-control text-capitalize" name="Fabric" placeholder="Enter kind of Fabrics" required>
                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Schedule Get</label>
                                        <input type="datetime-local" name="date" v-model="date" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Total Price</label>
                                        <input type="number" name="price" v-model="price" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Payment Method</label>
                                        <select class="selectpicker form-control" name="paymentMethod" data-width="100%" required>
                                            <option value="COD">COD</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-12">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="Message" placeholder="Enter brief about project..." rows="3">We will come to check your things. please wait.</textarea>
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-12">
                                        <div class="buttons float-end">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                            <button type="button" class="btn btn-outline-primary ms-2" data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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