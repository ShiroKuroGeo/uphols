<?php
session_start();
$pageTitle = $_SESSION['firstname'];

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/adminFullNav.php');
?>
<section class="container-fluid p-4" id="design-admin">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Designs</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../index.php">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="index.php">Design</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                List
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="#" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addDesign">Create a Design</a>
                    <div class="modal fade" id="addDesign" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Design</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="col-md-12 col-lg-12">
                                            <h4 class="my-4 text-center fw-bold">Customization Design</h4>
                                            <form @submit="storeCustomization" class="needs-validation mb-5" novalidate>
                                                <div class="row g-3">
                                                    <!-- Types, TypesPrice, color, colorPrice, fabric, fabricPrice -->
                                                    <div class="col-12">
                                                        <label for="address2" class="form-label">Types</label>
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <input type="text" name="Types" id="Types" class="form-control col-10" placeholder="Enter Types">
                                                            </div>
                                                            <div class="col-4">
                                                                <input type="number" name="TypesPrice" id="TypesPrice" class="form-control col-2" placeholder="Types Price">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mb-2">
                                                        <label for="address" class="form-label">Color</label>
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <input type="text" name="color" id="color" class="form-control col-10" placeholder="Enter Color">
                                                            </div>
                                                            <div class="col-4">
                                                                <input type="number" name="colorPrice" id="colorPrice" class="form-control col-2" placeholder="Color Price">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mb-2">
                                                        <label for="address" class="form-label">Fabrics</label>
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <input type="text" name="fabric" id="fabric" class="form-control col-10" placeholder="Enter Fabric Type">
                                                            </div>
                                                            <div class="col-4">
                                                                <input type="number" name="fabricPrice" id="fabricPrice" class="form-control col-2" placeholder="Fabric Price">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <button class="btn btn-md col-12 btn-outline-primary">Save Design</button>
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
    </div>
    <div class="row justify-content-md-between mb-4 mb-xl-0 gx-3">
        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="mb-lg-4 mb-2">
                <input type="search" v-model="searchThisDesign" class="form-control col-5" placeholder="Search by Type Name">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive overflow-y-hidden">
                    <table class="table mb-0 text-nowrap table-hover table-centered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Types</th>
                                <th scope="col">T-Price</th>
                                <th scope="col">Color</th>
                                <th scope="col">C-Price</th>
                                <th scope="col">Fabric Type</th>
                                <th scope="col">F-Price</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(d,index) in searchDesign">
                                <td>
                                    {{ 1 + index++ }}
                                </td>
                                <td class="text-capitalize">
                                    {{ d.Types }}
                                </td>
                                <td>
                                    {{ d.typePrice }}
                                </td>
                                <td class="text-capitalize">
                                    {{ d.Color }}
                                </td>
                                <td>
                                    {{ d.colorPrice }}
                                </td>
                                <td class="text-capitalize">
                                    {{ d.fabric }}
                                </td>
                                <td>
                                    {{ d.fabricPrice }}
                                </td>
                                <td>
                                    {{ dateToString(d.created_at) }}
                                </td>
                                <td>
                                    <div class="dropdown dropstart">
                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="Dropdown1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="Dropdown1">
                                            <span class="dropdown-header">Settings</span>
                                            <a class="dropdown-item" href="#" @click="getDesignData(d.requestForm_id)" data-bs-toggle="modal" data-bs-target="#UpdateActivate">
                                                <i class="fa-solid fa-pen-to-square me-2"></i>Edit Details
                                            </a>
                                            <a class="dropdown-item" href="#" @click="getDesignData(d.requestForm_id)" class="btn btn-sm btn-outline-danger ms-1" data-bs-toggle="modal" data-bs-target="#deleteProduct">
                                                <i class="fa-regular fa-trash-can me-2"></i>Delete
                                            </a>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="UpdateActivate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Design</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <div class="col-md-12 col-lg-12" v-for="s in selectedDesign">
                                                            <h4 class="mb-3">Customization Design Update</h4>
                                                            <form @submit="updateDesignId(s.requestForm_id)" class="needs-validation mb-5" novalidate>
                                                                <div class="row g-3">

                                                                    <div class="col-12">
                                                                        <label for="address2" class="form-label">Types</label>
                                                                        <div class="row">
                                                                            <div class="col-8">
                                                                                <input type="text" name="typesUpdate" id="typesUpdate" class="form-control col-10" :value="s.Types" placeholder="Enter Types">
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <input type="number" name="TypesPriceUpdate" id="TypesPriceUpdate" class="form-control col-2" :value="s.typePrice" placeholder="Types Price">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 mb-2">
                                                                        <label for="address" class="form-label">Color</label>
                                                                        <div class="row">
                                                                            <div class="col-8">
                                                                                <input type="text" name="colorUpdate" id="colorUpdate" class="form-control col-10" :value="s.Color" placeholder="Enter Color">
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <input type="number" name="colorPriceUpdate" id="colorPriceUpdate" class="form-control col-2" :value="s.colorPrice" placeholder="Color Price">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 mb-2">
                                                                        <label for="address" class="form-label">Fabrics</label>
                                                                        <div class="row">
                                                                            <div class="col-8">
                                                                                <input type="text" name="fabricUpdate" id="fabricUpdate" class="form-control col-10" :value="s.fabric" placeholder="Enter Fabric Type">
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <input type="number" name="fabricPriceUpdate" id="fabricPriceUpdate" class="form-control col-2" :value="s.fabricPrice" placeholder="Fabric Price">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <button class="btn btn-md col-12 btn-outline-primary">Save Design</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" v-for="s in selectedDesign">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Design</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container text-center">
                                                        <div class="col-md-12 col-lg-12">
                                                            <h4 class="mb-3">Are you sure you want to delete design type <br> {{ s.Types }} and color {{ s.Color }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button @click="deleteDesignId(s.requestForm_id)" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="!searchDesign.length">
                                <td class="text-capitalize">
                                    No Data Yet
                                </td>
                                <td class="text-capitalize">
                                    No Data Yet
                                </td>
                                <td class="text-capitalize">
                                    No Data Yet
                                </td>
                                <td class="text-capitalize">
                                    No Data Yet
                                </td>
                                <td class="text-capitalize">
                                    No Data Yet
                                </td>
                                <td class="text-capitalize">
                                    No Data Yet
                                </td>
                                <td class="text-capitalize">
                                    No Data Yet
                                </td>
                                <td class="text-capitalize">
                                    No Data Yet
                                </td>
                                <td class="text-capitalize">
                                    No Data Yet
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