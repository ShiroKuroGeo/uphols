<?php
session_start();
$pageTitle = $_SESSION['firstname'];

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerHeader.php');
?>

<!-- Start of the content -->

<div class="my-5"><br></div>
<div id="customer-profile">
    <div class="container panel-shadow my-5" v-for="ins in customerInfo">
        <div class="row gutters d-flex justify-content-center">
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100  border shadow p-1 rounded">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-12 text-center fw-bold mb-2">
                                Addresses
                            </div>
                            <div class="table table-responsive panel-shadow" style="overflow-y: auto; height: 300px;">
                                <table class="table table-responsive table-hover">
                                    <thead class="text-light text-center" style="position: sticky; top: 0;">
                                        <tr class="bg-dark mb-2">
                                            <th scope="col" class="rounded-start"><small>Region</small></th>
                                            <th scope="col"><small>Province</small></th>
                                            <th scope="col"><small>City</small></th>
                                            <th scope="col"><small>Barangay</small></th>
                                            <th scope="col"><small>Street</small></th>
                                            <th scope="col"><small>ZipCode</small></th>
                                            <th scope="col" class="text-center rounded-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="rounded" v-for="(adrs,index) in customerAddress">
                                            <td scope="col" class="text-center" width="5%"><small>{{
                                                    adrs.address_region
                                                    }}</small></td>
                                            <td scope="col" class="text-center" width="5%"><small>{{
                                                    adrs.address_province }}</small></td>
                                            <td scope="col" class="text-center" width="5%"><small>{{
                                                    adrs.address_city
                                                    }}</small></td>
                                            <td scope="col" class="text-center" width="5%"><small>{{
                                                    adrs.address_barangay }}</small></td>
                                            <td scope="col" class="text-center" width="5%"><small>{{
                                                    adrs.address_street
                                                    }}</small></td>
                                            <td scope="col" class="text-center" width="5%"><small>{{
                                                    adrs.address_zipCode }}</small></td>
                                            <td scope="col" class="text-center" width="5%"><small>
                                                    <button class="btn btn-sm btn-danger" @click="selectedDeleteAddress(adrs.address_id)" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash-o" height="50" aria-hidden="true"></i></button>
                                                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Delete this Address</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="title display-6">
                                                                        Are you sure you want to delete this
                                                                        address?
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" @click="deleteAddress(selectedAddressDelete)" data-bs-dismiss="modal">Delete
                                                                        Address</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12"><button class="btn btn-mb btn-outline-warning  col-12 rounded" data-bs-toggle="modal" data-bs-target="#addNewAddress"><i class="fa fa-plus-circle text-danger" aria-hidden="true"></i><span class="text-danger"> Add New Address</span></button>
                        </div>
                        <div class="modal fade" id="addNewAddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-white">
                                    <div class="modal-body">
                                        <form @submit="addAddress">
                                            <div class="row gutters">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <h6 class="mt-3 mb-2 text-primary text-center">Set Address
                                                    </h6>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 visually-hidden">
                                                    <div class="form-group">
                                                        <label for="Region">Region</label>
                                                        <input type="text" class="form-control form-control-md" value="Visayas" name="Region" id="Region" placeholder="Enter Region">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label for="sTate">Province</label>
                                                        <input type="text" class="form-control form-control-md" name="Province" id="Province" placeholder="Enter Province">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label for="ciTy">City</label>
                                                        <input type="name" class="form-control form-control-md" name="City" id="City" placeholder="Enter City">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label for="Barangay">Barangay</label>
                                                        <input type="name" class="form-control form-control-md" name="Barangay" id="Barangay" placeholder="Enter Barangay">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label for="Street">Street Name</label>
                                                        <input type="name" class="form-control form-control-md" name="Street" id="Street" placeholder="Enter Street">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label for="zIp">Zip Code</label>
                                                        <input type="text" class="form-control form-control-md" name="Zip" id="Zip" placeholder="Zip Code">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 col-12">
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-md px-5 btn-primary">Set Address</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/footerLink.php');
    ?>
</div>

<!-- End of the content -->

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerFooter.php');
?>