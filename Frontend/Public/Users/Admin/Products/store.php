<?php
session_start();
$pageTitle = $_SESSION['firstname'];

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/adminFullNav.php');
?>
<div class="container-fluid p-0" id="product-admin">
    <section class="content-header">
        <div class="content-header my-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0 fw-bold">Add Products</h1>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb my-auto">
                            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-dark">Home</a></li>
                            <li class="breadcrumb-item active text-dark"><a href="index.php" class="text-decoration-none text-dark">Products<sup>{{ productLength }}</sup></a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <main class="row vh-100">
        <div class="container d-flex justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">General</h3>
                    </div>
                    <div class="card-body">
                        <form @submit="getStoreProduct" class="row" id="resetAddForm">
                            <div class="form-group mb-3">
                                <label for="inputName">Product Image</label><br>
                                <button type="button" class="btn btn-warning btn-sm" onclick="document.getElementById('image').click()">
                                    <i class="fa fa-fw fa-camera me-2"></i>
                                    <span>Add Photo</span>
                                </button>
                                <input type="file" name="file" id="image" class="visually-hidden" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="inputName">Product Name</label>
                                <input type="text" class="form-control form-control-md" name="name" id="addProductName" placeholder="Add Product Name" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="inputDescription">Product Quantity</label>
                                <input type="number" class="form-control form-control-md w-100" name="quantity" id="addProductQuantity" placeholder="Add Product Quantity" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="inputClientCompany">Product Price</label>
                                <input type="number" class="form-control form-control-md w-100" name="price" id="addProductPrice" placeholder="Add Product Price" required>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Product Description</label>
                                <textarea name="description" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-sm btn-outline-primary mt-3 col-3 py-2 float-end">Add Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/AdminFooter.php');
?>