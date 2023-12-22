<?php
session_start();
$pageTitle = "My Carts";

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerHeader.php');
?>

<!-- Start of the content -->
<section class="vh-100 bg-light" id="customer-cart">
    <!-- cart + summary -->
    <section class="my-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card border shadow-0">
                        <div class="m-3" style="height: 55vh; overflow-x: hidden;">
                            <h4 class="card-title pb-4">Your shopping cart</h4>
                            <div class="row gy-0 mb-4 bg-light py-2 px-3 rounded" v-for="(c,index) of carts">
                                <div class="col-lg-1 col-5 col-sm-1">
                                    {{ index + 1}}
                                    <input type="checkbox" @click="isShown" v-model="selectedProduct" @change="storeAllSelectedCartData(selectedProduct)" name="selected" id="selected" :value="c.cart_id">
                                </div>
                                <div class="col-lg-5 col-6 col-sm-5">
                                    <div class="me-lg-12">
                                        <div class="d-flex">
                                            <img :src="'/uphols/Assets/Images/' + c.product_picture" class="rounded" style="width: 45px; height: 45px;" />
                                            <div class="my-auto">
                                                <a href="#" class="nav-link">{{ c.productName }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12 d-flex flex-row flex-lg-column flex-xl-row text-nowrap ">
                                    <div class="d-flex col-4 me-1">
                                        <button type="button" :disabled="c.quantityCart >= c.productQuantity" @click="plusc(index, c.cart_id)" class="btn btn-sm"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        <input type="number" name="quantity" :id="c.cart_id" :value="c.quantityCart" @change="updateThisCartQuality(c.cart_id)" class="form-control">
                                        <button type="button" :disabled="c.quantityCart <= 1" @click="minusc(index, c.cart_id)" class="btn btn-sm"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                    </div>
                                    <small class="col-4">
                                        <text class="h6">&#8369; {{ c.productPrice * c.quantityCart }}</text> <br />
                                        <small class="text-muted text-nowrap"> P{{ c.productPrice }} / per item </small>
                                    </small>
                                    <div class="col-4">
                                        <div class=" d-flex justify-content-end align-items-end">
                                            <!-- <a @click="updateThisCartQuality(c.cart_id)" class="btn btn-sm btn-light icon-hover-primary">Update</a> -->
                                            <button data-bs-toggle="modal" data-bs-target="#removeItemCart" class="btn btn-sm btn-light text-danger icon-hover-danger" @click="selectedToRemoveItem(c.cart_id)">Remove</button>

                                            <div class="modal fade" id="removeItemCart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Item Cart</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this item.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="removeThisData(itemSelected)">Okay</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top pt-4 mx-4 mb-4">
                            <p><i class="fas fa-truck text-muted fa-lg"></i> Free Delivery within 1-2 weeks</p>
                            <p class="text-muted">
                                Deliveries are typically fulfilled based on the selected shipping method during checkout,
                                with standard options taking several business days and expedited services ensuring quicker
                                arrival for an extra fee. Once an order is processed, a tracking number is usually provided,
                                allowing customers to monitor the shipment's progress until it reaches its destination.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card shadow-0 border mb-4 visually-hidden" id="acceptSelected">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Total Selected Price:</p>
                                <p class="mb-2 fw-bold">&#8369;{{ totalSelected }}</p>
                            </div>
                            <hr />
                            <div class="col-12 mt-3">
                                <a class="btn btn-success w-100 shadow-0 mb-2" data-bs-toggle="modal" data-bs-target="#purchaseSelectedItem">Make Purchase ({{selectedProduct.length}})</a>
                                <a href="index.php" class="btn btn-light w-100 border mt-2"> Back to shop </a>
                                <div class="modal fade" id="purchaseSelectedItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Logout Confirmation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="title">
                                                    <div class="card-body">
                                                        <div class="col-12 mb-1">
                                                            Select Address: <span class="text-danger">*</span> <br>
                                                            <select name="address" v-model="role" id="address" class="form-control form-control-sm">
                                                                <option value="">Select Address</option>
                                                                <option v-for="(add,index) in customerAddress" :value="add.address_id">{{ add.address_city }}, {{ add.address_barangay }}, {{ add.address_province }}, {{ add.address_zipCode }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    Are you sure you want to Purchase all the item's in the cart?
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" @click="purchaseSelectedItem(selectedProduct)" class="btn btn-success w-100 shadow-0 mb-2" id="popoverButton" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Successfully added to your order">Purchase All</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-0 border" id="NoneSelected">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Total price:</p>
                                <p class="mb-2 fw-bold">&#8369;{{ totalPriceCart }}</p>
                            </div>
                            <hr />
                            <div class="mt-3">
                                <a class="btn btn-success w-100 shadow-0 mb-2" data-bs-toggle="modal" data-bs-target="#purchaseConfirmation"> Make Purchase </a>
                                <a href="index.php" class="btn btn-light w-100 border mt-2"> Back to shop </a>
                                <div class="modal fade" id="purchaseConfirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Logout Confirmation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="title">
                                                    <div class="card-body">
                                                        <div class="col-12 mb-1">
                                                            Select Address: <span class="text-danger">*</span> <br>
                                                            <select name="address" v-model="role" id="Alladdress" class="form-control form-control-sm">
                                                                <option value="">Select Address</option>
                                                                <option v-for="(add,index) in customerAddress" :value="add.address_id">{{ add.address_city }}, {{ add.address_barangay }}, {{ add.address_province }}, {{ add.address_zipCode }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    Are you sure you want to Purchase all the item's in the cart?
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" @click="purchaseAllItem(cart_ids)" class="btn btn-primary" id="popoverButton" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Successfully added to your order">Purchase All</button>
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
    </section>
    <!-- cart + summary -->
    <section>
        <div class="container my-5" v-if="recommended != 0">
            <header class="mb-4">
                <h3>Recommended items</h3>
            </header>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6" v-for="rp in recommended">
                    <div class="card px-4 border shadow-0 mb-4 mb-lg-0">
                        <a href="#" class="">
                            <img :src="'/uphols/Assets/Images/' + rp.product_picture" class="card-img-top rounded-2" />
                        </a>
                        <div class="card-body d-flex flex-column pt-3 border-top">
                            <a href="#" class="nav-link">{{ rp.productName }}</a>
                            <div class="price-wrap mb-2">
                                <strong class="">P{{ rp.productPrice }}</strong>
                            </div>
                            <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
                                <a @click="addToCart(rp.product_id)" class="btn btn-outline-primary w-100">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Recommended -->

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/footerLink.php');
    ?>
</section>

<!-- End of the content -->

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerFooter.php');
?>