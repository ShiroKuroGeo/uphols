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
<div class="container-fluid p-4" id="recommendation-admin">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-bottom pb-3 mb-3">
                    <div class="mb-3 mb-lg-0">
                        <h1 class="mb-0 h2 fw-bold">Recommendation</h1>
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="../index.php" class="newPrimary">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item active newPrimary" aria-current="page">
                                    Recommendations
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="card panel-shadow">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title text-sec fw-bold">Folders</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item active">
                                    <a href="recommendation.php" class="nav-link d-flex justify-content-between">
                                        <div class="icons text-sec">
                                            <i class="fas fa-inbox"></i>
                                            Inbox
                                        </div>
                                        <span>{{ recom }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title text-sec fw-bold">Inbox</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                        <tr v-for="rec in dataRecommendation">
                                            <td class="mailbox-name">
                                                <a class="text-decoration-none text-sec name" :href="'reviewRecom.php?recomId=' + rec.id">{{ rec.fullname }}</a>
                                            </td>
                                            <td class="mailbox-subject">
                                                <a class="text-decoration-none text-sec message" :href="'reviewRecom.php?recomId=' + rec.id">
                                                    <b class="name">{{ rec.email }} || {{ rec.phoneNumber }}</b> - {{ rec.message }}
                                                </a>
                                            </td>
                                            <td class="h6"><small>{{ rec.created_at }}</small></td>
                                        </tr>
                                        <tr v-if="!recom">
                                            <td class="mailbox-name">
                                                <a class="text-decoration-none text-sec name" href="#">No Data</a>
                                            </td>
                                            <td class="mailbox-subject">
                                                <a class="text-decoration-none text-sec message" href="#">
                                                    <b class="name">No Data || No Data</b> - No Data
                                                </a>
                                            </td>
                                            <td class="h6"><small>No Data</small></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Admin/AdminFooter.php');
?>