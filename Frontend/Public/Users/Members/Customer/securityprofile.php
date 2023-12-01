<?php
session_start();
$pageTitle = $_SESSION['firstname'];

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerHeader.php');
?>

<div class="my-5"></div>
<main id="customer-profile">
    <section class="pt-5 pb-5" v-for="ins in customerInfo">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div class="pt-16 rounded-top bg-primary" style="background: url(/uphols/Assets/Images/profile-bg.jpg) no-repeat; background-size: cover;"></div>
                    <div class="card px-4 pt-2 pb-4 shadow-sm rounded-top-0 rounded-bottom-0 rounded-bottom-md-2 ">
                        <div class="d-flex align-items-end justify-content-between  ">
                            <div class="d-flex align-items-center">
                                <div class="me-2 position-relative d-flex justify-content-end align-items-end mt-n5">
                                    <img :src="'/uphols/Assets/Images/' + ins.profilePicture" class="avatar-xl rounded-circle border border-4 border-white" alt="avatar" data-bs-toggle="modal" data-bs-target="#viewProfilePicture">
                                    <div class="modal fade" id="viewProfilePicture" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <img :src="'/uphols/Assets/Images/' + ins.profilePicture" alt="Generic placeholder image" class="img-fluid img-thumbnail mb-2" style="max-height: 100vw;max-width: 100vh">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lh-1 text-capitalize">
                                    <h2 class="mb-0">{{ ins.lastname }} , {{ ins.firstname }}
                                        <a href="#" class="text-decoration-none" data-bs-toggle="tooltip" data-placement="top" title="Beginner">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
                                                <rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE"></rect>
                                                <rect x="11" y="2" width="2" height="12" rx="1" fill="#754FFE"></rect>
                                            </svg>
                                        </a>
                                    </h2>
                                    <p class=" mb-0 d-block text-capitalize">{{ ins.email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-0 mt-md-4">
                <div class="col-lg-3 col-md-4 col-12">
                    <nav class="navbar navbar-expand-md navbar-light shadow-sm mb-4 mb-lg-0 sidenav">
                        <a class="d-xl-none d-lg-none d-md-none text-inherit fw-bold" href="#">Menu</a>
                        <button class="navbar-toggler d-md-none icon-shape icon-sm rounded bg-primary text-light" type="button" data-bs-toggle="collapse" data-bs-target="#sidenav" aria-controls="sidenav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="fe fe-menu"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="sidenav">
                            <div class="navbar-nav flex-column">
                                <span class="navbar-header">Account Settings</span>
                                <ul class="list-unstyled ms-n2 mb-0">
                                    <li class="nav-item">
                                        <a class="nav-link" href="profile.php"><i class="fa fa-user nav-icon" aria-hidden="true"></i>Edit Profile</a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="securityprofile.php"><i class="fa fa-lock nav-icon" aria-hidden="true"></i>Security</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutConfirmation"><i class="fa fa-sign-out nav-icon" aria-hidden="true"></i>Sign Out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">Security</h3>
                            <p class="mb-0">
                                Edit your account settings and change your password here.
                            </p>
                        </div>
                        <div class="card-body">
                            <h4 class="mb-0">Email Address</h4>
                            <p>
                                Your current email address is
                                <span class="text-success text-capitalize">{{ ins.email }}</span>
                            </p>
                            <form @submit="updateInformation" class="row gx-3">
                                <div class="mb-3 col-12 col-md-6 visually-hidden">
                                    <div class="form-group">
                                        <label for="fullName">First Name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" :placeholder="ins.firstname" :value="ins.firstname">
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-6 visually-hidden">
                                    <div class="form-group">
                                        <label for="fullName">Last Name</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" :placeholder="ins.lastname" :value="ins.lastname">
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-6 visually-hidden">
                                    <div class="form-group">
                                        <label for="eMail">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" :placeholder="ins.username" :value="ins.username">
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-6 visually-hidden">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" :placeholder="ins.phone" :value="ins.phone">
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="website">Email Address</label>
                                        <input type="email" class="form-control" :value="ins.email" name="email" id="email" :placeholder="ins.email">
                                    </div>
                                    <button class="btn btn-primary mt-2">Update Details</button>
                                </div>
                            </form>
                            <hr class="my-5">
                            <div>
                                <h4 class="mb-0">Change Password</h4>
                                <p>
                                    We will email you a confirmation when changing your
                                    password, so please expect that email after submitting.
                                </p>
                                <div class="form">
                                    <div class="alert alert-danger visually-hidden" id="notMatch" role="alert">
                                        New Password not match!
                                    </div>
                                    <div class="alert alert-danger visually-hidden" id="oldPassNotCorrect" role="alert">
                                        Old Password not match!
                                    </div>
                                    <div class="mb-3 col-lg-6 col-md-12 col-12" id="checkPassword">
                                        <label class="form-label me-3" for="form2Example11">Old Password</label>
                                        <input type="password" id="oldPassword" name="oldPassword" class="form-control disabled" placeholder="Enter Old Password" />
                                        <label class="form-label text-success visually-hidden" id="checked">&#10003;</label><br>
                                        <button class="btn btn-primary mt-2" @click="checkOldPassword">Continue to New Password</button>
                                    </div>
                                    <form @submit="changePassword" id="changeToNewPassword" class="visually-hidden">
                                        <div class="mb-3 col-lg-6 col-md-12 col-12">
                                            <input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="Enter New Password" />
                                            <label class="form-label" for="form2Example22">New Password</label>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-12 col-12">
                                            <input type="password" id="retypePassword" name="retypePassword" class="form-control" placeholder="Enter Retype Password" />
                                            <label class="form-label" for="form2Example22">Retype Password</label>
                                        </div>
                                        <button class="btn btn-primary mt-2">Change Password</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/footerLink.php');
?>
</div>

<!-- End of the content -->

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerFooter.php');
?>