<!-- Header of Authentication -->
<?php
$pageTitle = "Forgot Password";

// $_SERVER['DOCUMENT_ROOT'] to specify an absolute path dynamically. 
// which represents the root directory of your server.
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Auth/AuthHeader.php');
?>

<!-- Start of Login Content -->
<div id="auth-content">
    <div class="container-fluid vh-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5 shadow">
                <img src="/uphols/Assets/Images/illustrationUpholstery.png" class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 mt-auto border border-4 shadow-lg">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <div class="progress border">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" :style="'width: '+progressBarForResetPassword+'%'"></div>
                            </div>
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>Enter your email to confirm if you are already registered..<br><span class="fw-bold">( Code Reset Password )</span></p></p>
                            <!-- Enter existed Email to Reset Password -->
                            <div class="panel-body" id="enterEmailToResetPassword">
                                <div class="form">
                                    <fieldset>
                                        <span id="ifNoDataExisted" class="d-flex justify-content-start alert alert-danger visually-hidden">
                                            Email is not registered yet.
                                        </span>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="emailInput" placeholder="Email Address" class="form-control form-control-md rounded" type="email" oninvalid="setCustomValidity('Please enter a valid email address!')" onchange="try{setCustomValidity('')}catch(e){}" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button @click="confirmEmail" class="col-12 btn btn-md btn-primary btn-block mt-3">Confirm Email</button>
                                        </div>
                                        <a href="./gmailForgotpassword.php" class="float-start mt-2">Use another way? (Gmail)</a>
                                    </fieldset>
                                </div>
                            </div>
                            <!-- Confirm Password to Reset Password -->
                            <div class="panel-body visually-hidden" id="confirmCodeToResetPassword">
                                <div class="input-group">
                                    <span id="ifCodeIsNotExisted" class="col-12 d-flex justify-content-start alert alert-danger visually-hidden">
                                        Code is not valid.
                                    </span>
                                    <div class="form-group col-12" id="resetPassword">
                                        <div class="input-group">
                                            <input id="myCode" placeholder="Enter Code" class="form-control form-control-md rounded" type="text" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button @click="resetPassword" class="col-12 btn btn-md btn-primary btn-block mt-3">Reset Password</button>
                                </div>
                            </div>
                            <!-- Reset Password -->
                            <div class="panel-body visually-hidden" id="resetPasswordNow">
                                <div class="input-group">
                                    <span id="notTheSame" class="col-12 d-flex justify-content-start alert alert-danger visually-hidden">
                                        PASSWORD NOT MATCH!.
                                    </span>
                                    <div class="alert alert-primary d-flex align-items-center visually-hidden" id="eightletters" role="alert">
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        <div>
                                            Password Should Atleast 8 characters
                                        </div>
                                    </div>
                                    <div class="form-group col-12" id="resetPassword">
                                        <input id="newPassword" placeholder="Enter New Password" class="form-control form-control-md rounded" type="password" required="">
                                        <input id="renewPassword" placeholder="Retype New Password" class="form-control form-control-md rounded mt-1" type="password" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button @click="changePassword" class="col-12 btn btn-md btn-primary btn-block mt-3">Reset Password</button>
                                </div>
                            </div>
                            <!-- Reset Password -->
                            <div class="panel-body visually-hidden" id="allAreDone">
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading"><i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i></h4>
                                    <h4 class="alert-heading">Well done!</h4>
                                    <p>Aww yeah, you successfully change your password.</p>
                                    <a href="../login.php" class="btn btn-md btn-primary col-12">Go to Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="d-flex mt-auto text-center text-ms-start justify-content-between py-4 px-4 px-xl-5 bg-primary float-bottom">
                <!-- Copyright -->
                <div class="text-white mb-3 mb-md-0">
                    Copyright © 2020. All rights reserved.
                </div>
                <!-- Copyright -->

                <!-- Right -->
                <div>
                    <a href="#!" class="text-white me-4">
                        <i class="fab fa-facebook-f"></i> <!-- Change this Icon -->
                    </a>
                    <a href="#!" class="text-white me-4">
                        <i class="fab fa-twitter"></i> <!-- Change this Icon -->
                    </a>
                    <a href="#!" class="text-white me-4">
                        <i class="fab fa-google"></i> <!-- Change this Icon -->
                    </a>
                    <a href="#!" class="text-white">
                        <i class="fab fa-linkedin-in"></i> <!-- Change this Icon -->
                    </a>
                </div>
                <!-- Right -->
            </footer>
        </div>
    </div>
</div>
<!-- End of Login Content -->

<!-- Footer of Authentication -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Auth/AuthFooter.php');
?>