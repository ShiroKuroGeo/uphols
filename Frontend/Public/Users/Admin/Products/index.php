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
<section class="container-fluid p-4" id="product-admin">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <div class="mb-3 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Products <span class="fs-5 text-muted">({{ searchProducts.length }})</span></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="admin-dashboard.html" class="newPrimary">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#" class="newPrimary">Product</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Products
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-between mb-4 mb-xl-0 ">
        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="mb-2 mb-lg-4">
                <input type="search" class="form-control col-12" placeholder="Search Product Name" v-model="searchProduct">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-3 col-xl-4 col-lg-6 col-12 mb-4">
            <a href="store.php">
                <div class="card h-100 border border-2 shadow-none card-dashed-hover p-12">
                    <div class="card-body d-flex flex-column justify-content-center text-center">
                        <i class="fa fa-plus fa-5x" aria-hidden="true"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-3 col-xl-4 col-lg-6 col-12 mb-4" v-for="pro in searchProducts">
            <div class="card h-100">
                <div class="card-body border">
                    <div class="dropdown dropstart position-absolute col-10">
                        <a href="#" class="btn-icon btn btn-ghost btn-sm rounded-circle float-end" id="dropdownProjectOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownProjectOne">
                            <span class="dropdown-header">Settings</span>
                            <a class="dropdown-item" href="#" @click="deleteProduct(pro.product_id)" data-bs-toggle="modal" data-bs-target="#deleteProduct">
                                <i class="fa-regular fa-trash-can me-2" style="color: #219EBC"></i>
                                Delete
                            </a>
                            <a class="dropdown-item" href="#" @click="deleteProduct(pro.product_id)" data-bs-toggle="modal" data-bs-target="#UpdateActivate">
                                <i class="fa-solid fa-pen-to-square me-2" style="color: #219EBC"></i>
                                Update
                            </a>
                        </div>
                        <div class="modalDeleteActivate">
                            <div class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content" v-for="user in showdDeleteProduct">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Button</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete {{ user.productName }}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" @click="deleteSelectedProduct(user.product_id)" data-bs-dismiss="modal">Delete Product</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modalUpdateActivate">
                            <div class="modal fade" id="UpdateActivate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" v-for="user in showdDeleteProduct">
                                            <form @submit="updateSelectedProduct(user.product_id)">
                                                <div class="form-group">
                                                    <label for="inputName">Product Name</label>
                                                    <input type="text" class="form-control form-control-sm" name="productName" :value="user.productName" id="productName" placeholder="Add Product Name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputDescription">Product Quantity</label>
                                                    <input type="number" class="form-control form-control-sm w-100" name="productQuantity" :value="user.productQuantity" id="productQuantity" placeholder="Add Product Quantity" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputClientCompany">Product Prize</label>
                                                    <input type="number" class="form-control form-control-sm w-100" name="productPrice" :value="user.productPrice" id="productPrice" placeholder="Add Product Price" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputClientCompany">Product Status</label>
                                                    <select name="productStatus" id="productStatus" class="form-control form-control-sm w-100">
                                                        <option :value="user.productStatus == 1 ? '1' : user.productStatus == 2 ? '2' : '0'">CV: {{ user.productStatus == 1 ? 'Displayed' : user.productStatus == 2 ? 'Do Not Displayed' : 'Recommendation' }}</option>
                                                        <option value="0">Recommendation</option>
                                                        <option value="1">Displayed</option>
                                                        <option value="2">Do Not Displayed</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputDescription">Product Description</label>
                                                    <textarea id="productDescription" class="form-control" :value="user.productDescription" rows="4"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-sm btn-outline-primary mt-3 col-4 py-2 float-end">Update Product</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <img :src="'/uphols/Assets/Images/' + pro.product_picture" :alt="productName" width="150" height="150" /><br>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-0"><a href="#" class="text-inherit text-capitalize">Product Name: {{ pro.productName }}</a></h4>
                            <span class="text-muted fs-6">
                                Status: <small :class="pro.productStatus == 1 ? 'text-primary rounded' : pro.productStatus == 2 ? 'text-danger rounded' : 'text-warning rounded' ">{{ pro.productStatus == 1 ? 'Displayed' : pro.productStatus == 2 ? 'Do Not Displayed' : 'Recommendation' }}</small>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-0">
                    <div class="d-flex justify-content-between">
                        <div class="w-50 py-3 px-4">
                            <h6 class="mb-0 text-muted">Quantity:</h6>
                            <p class="text-dark fs-6 fw-semibold mb-0">{{ pro.productQuantity }}</p>
                        </div>
                        <div class="border-start w-50 py-3 px-4 ">
                            <h6 class="mb-0 text-muted">Price:</h6>
                            <p class="text-dark fs-6 fw-semibold mb-0">{{ pro.productPrice }}</p>
                        </div>
                        <div class="border-start w-50 py-3 px-4 ">
                            <h6 class="mb-0 text-muted">Sales:</h6>
                            <p class="text-dark fs-6 fw-semibold mb-0">{{ pro.productSales }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-4 col-lg-6 col-12 mb-4" v-if="!searchProducts.length">
            <div class="card h-100">
                <div class="card-body border">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <h5 class="text-center text-muted">
                            No Product Registered Yet!
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>

</section>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/AdminFooter.php');
?>