<?php
session_start();
$pageTitle = $_SESSION['firstname'];

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/adminFullNav.php');
?>
<div class="container-fluid p-4" id="recommendation-admin">
    <main class="row">
        <div class="container d-flex justify-content-center">
            <div class="col-md-9 my-4">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-sec fw-bold">Read Mail</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body px-5" v-for="rec in dataSelectedRecommendation">
                        <div class="mailbox-read-info text-sec">
                            <h5>Message Subject Is Placed Here</h5>
                            <h6>From: {{ rec.email }}
                            <h6>Phone Number: {{ rec.phoneNumber }}
                            <span class="mailbox-read-time float-right text-sec "> -  {{  dateToString(rec.created_at) }}</span></h6>
                        </div>
                        <div class="mailbox-read-message px-3 text-sec">
                            <p>Hello Villarubia Upholstery Shop,</p>

                            <p>{{ rec.message }}</p>

                            <p>Thanks,<br>{{ rec.fullname }}</p>
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