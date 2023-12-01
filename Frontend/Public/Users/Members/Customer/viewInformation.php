<?php
    session_start();
    $pageTitle = "My Orders";
    
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerHeader.php');
?>
<style>
    body{
    
    background-color:#B3E5FC;
    border-radius: 10px;

}


.card{
  width: 400px;
  border: none;
  border-radius: 10px;
   
  background-color: #fff;
}



.stats{

      background: #f2f5f8 !important;

    color: #000 !important;
}
.articles{
  font-size:10px;
  color: #a1aab9;
}
.number1{
  font-weight:500;
}
.followers{
    font-size:10px;
  color: #a1aab9;

}
.number2{
  font-weight:500;
}
.rating{
    font-size:10px;
  color: #a1aab9;
}
.number3{
  font-weight:500;
}
</style>
<!-- Start of the content -->

<div class="my-5"><br></div>

<section id="customer-profile">
    <div class="container px-4 px-lg-5 mt-5" v-for="n in selectedNotificationData">
    <div class="container mt-5 d-flex justify-content-center ">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="image me-2">
                <img :src="'/Uphols/Assets/Images/' + n.product_picture" class="rounded" width="155" height="155">
                </div>
                <div class="ml-3 w-100">
                   <h4 class="mb-0 mt-0">{{ n.productName }}</h4>
                   <span> Status : {{ n.transac_status == 1 ? 'Approve' : 'Decline' }}</span>
                   <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">
                    <div class="d-flex flex-column">
                        
                        <span class="articles">Total Price:</span>
                        <span class="number1"> P{{ n.transac_quantity * n.productPrice}}</span>
                    </div>
                    <div class="d-flex flex-column">
                        <span class="followers">Quantity: </span>
                        <span class="number2">980</span>
                    </div>
                    <div class="d-flex flex-column">
                        <span class="rating">Date to deliver:</span>
                        <span class="number3"> {{ n.date_delivery }}</span>  
                    </div>
                   </div>
                   <div class="row-md-5 border-right">
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-between align-items-between"><label class="labels">Region:</label><hr class="bg-primary pt-1 w-100"><span>{{ n.address_region }}</span></div>
                            <div class="col-md-12 d-flex justify-content-between align-items-between"><label class="labels">Province:</label><hr class="bg-primary pt-1 w-100"><span>{{ n.address_province }}</span></div>
                            <div class="col-md-12 d-flex justify-content-between align-items-between"><label class="labels">City:</label><hr class="bg-primary pt-1 w-100"><span>{{ n.address_city }}</span></div>
                            <div class="col-md-12 d-flex justify-content-between align-items-between"><label class="labels">Barangay:</label><hr class="bg-primary pt-1 w-100"><span>{{ n.address_barangay }}</span></div>
                            <div class="col-md-12 d-flex justify-content-between align-items-between"><label class="labels">Street:</label><hr class="bg-primary pt-1 w-100"><span>{{ n.address_street }}</span></div>
                            <div class="col-md-12 d-flex justify-content-between align-items-between"><label class="labels">ZipCode:</label><hr class="bg-primary pt-1 w-100"><span>{{ n.address_zipCode }}</span></div>
                        </div>
                    </div>
                    <div class="button mt-2 d-flex flex-row align-items-center">
                    <button class="btn btn-sm btn-primary w-100 ml-2">Okay</button>     
                   </div>
                </div>
                </div>       
                </div>      
            </div>            
         </div>
        <!-- <div class="container border border-4 rounded shadow bg-white mt-2 mb-2">
            <div class="d-flex justify-content-center align-items-center my-3">
                <h4 class="text-right mt-4 fw-bold">Order Information</h4>
            </div>
            <div class="row">
                <hr>
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5 mb-3 border shadow border-3">
                        <img class="border shadow mb-3" width="120" :src="'/Uphols/Assets/Images/' + n.product_picture">
                        <span class="font-weight-bold">{{ n.productName }}</span>
                    </div>
                </div>
                
                <div class="col-md-5 border-right">
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-between align-items-between"><label class="labels">Region:</label><hr class="bg-primary pt-1 w-100"><span>{{ n.address_region }}</span></div>
                            <div class="col-md-12 d-flex justify-content-between align-items-between"><label class="labels">Province:</label><hr class="bg-primary pt-1 w-100"><span>{{ n.address_province }}</span></div>
                            <div class="col-md-12 d-flex justify-content-between align-items-between"><label class="labels">City:</label><hr class="bg-primary pt-1 w-100"><span>{{ n.address_city }}</span></div>
                            <div class="col-md-12 d-flex justify-content-between align-items-between"><label class="labels">Barangay:</label><hr class="bg-primary pt-1 w-100"><span>{{ n.address_barangay }}</span></div>
                            <div class="col-md-12 d-flex justify-content-between align-items-between"><label class="labels">Street:</label><hr class="bg-primary pt-1 w-100"><span>{{ n.address_street }}</span></div>
                            <div class="col-md-12 d-flex justify-content-between align-items-between"><label class="labels">ZipCode:</label><hr class="bg-primary pt-1 w-100"><span>{{ n.address_zipCode }}</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 pt-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="text-right"> Status : {{ n.transac_status == 1 ? 'Approve' : 'Decline' }}</h4>
                        </div>
                        <div class="col-md-12"><label class="labels">Total Price: P{{ n.transac_quantity * n.productPrice}}</label></div><br>
                        <div class="col-md-12"><label class="labels">Date to deliver: {{ n.date_delivery }}</label></div>
                    </div>
                </div>
                
                <hr>
                <div class="col-12 d-flex justify-content-end my-2">
                    <a href="index.php" class="col-2">
                        <button class="btn btn-sm btn-outline-primary col-12">Okay</button>
                    </a>
                </div>
            </div>
        </div>         -->
    </div>

</section>

<!-- End of the content -->
<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Frontend/Components/Members/Customer/CustomerFooter.php');
?>