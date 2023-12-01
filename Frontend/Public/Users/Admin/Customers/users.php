<?php
session_start();
$pageTitle = $_SESSION['firstname'];

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/adminFullNav.php');
?>

<section class="container-fluid p-4" id="customer-admin">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page Header -->
            <div class="border-bottom pb-3 mb-3 d-flex justify-content-between align-items-center">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-1 h2 fw-bold">
                        Customer
                        <span class="fs-5 text-muted">({{ UserCount }})</span>
                    </h1>
                    <!-- Breadcrumb  -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../index.php">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Customers
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Tab -->
            <div class="tab-content">
                <!-- Tab Pane -->
                <div class="tab-pane fade show active" id="tabPaneGrid" role="tabpanel" aria-labelledby="tabPaneGrid">
                    <div class="mb-4">
                        <input type="text" name="seachUserFromTable" id="seachUserFromTable" v-model="searchUsers" class="form-control" placeholder="Search Name">
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-6 col-12" v-for="cust in searchUser">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="text-center">
                                        <div class="position-relative">
                                            <img :src="'/Uphols/Assets/Images/' + cust.profilePicture" class="rounded-circle avatar-xl mb-3" :alt="cust.profilePicture" @click="editUser(cust.user_id)" data-bs-toggle="modal" data-bs-target="#viewPiture">
                                            <div class="modal fade" id="viewPiture" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content" v-for="user in editSelectedUser">
                                                        <img :src="'/Uphols/Assets/Images/' + cust.profilePicture" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#" class="dropdown position-absolute mt-10 ms-n5" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-cogs" aria-hidden="true"></i>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <li><a class="dropdown-item" :href="'singleUser.php?user_id=' + cust.user_id" style="cursor: pointer">View Info</a></li>
                                                    <li><a class="dropdown-item" href="#" style="cursor: pointer" @click="editUser(cust.user_id)" class="btn btn-sm btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#editUser">Change User Visibility</a></li>
                                                </ul>
                                            </a>
                                        </div>
                                        <h4 class="mb-0 text-capitalize">{{ cust.firstname }} {{ cust.lastname }}</h4>
                                        <p class="mb-0">
                                            <i class="fe fe-map-pin me-1 fs-6"></i>{{cust.email}}
                                        </p>
                                        <p class="mb-0">
                                            <i class="fe fe-map-pin me-1 fs-6"></i>0{{cust.phone}}
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom py-2 mt-6">
                                        <span>Status</span>
                                        <span class="text-dark">{{ cust.stat == 1 ? "Active" : "Deactive" }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom py-2">
                                        <span>Joined at</span>
                                        <span> {{ dateToString(cust.created) }} </span>
                                    </div>
                                    <div class="d-flex justify-content-between pt-2">
                                        <span>Code</span>
                                        <span class="text-dark"> {{cust.code}} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 " v-if="!UserCount">
                            <h5 class="text-center text-muted">
                                No Registered Used Yet!
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" v-for="user in editSelectedUser">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ selectedRole == 2 ? 'Employee Edit' : 'Customer Edit' }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit="updateStatusOfUser(user.user_id)">
                        <span>Deactive | Active</span>
                        <select v-model="status" class="form-control form-control-sm mt-2" id="status">
                            <option value="">CV: {{ user.stat == 1 ? 'Active' : 'Deactive' }}</option>
                            <option :value="user.stat == 1 ? '2' : '1' ">{{ user.stat == 1 ? 'Deactive' : 'Active' }}</option>
                        </select><br>
                        <button class="btn btn-sm btn-primary form-control form-control-sm">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/AdminFooter.php');
?>