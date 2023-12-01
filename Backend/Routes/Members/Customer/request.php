<?php

    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Controllers/requestController.php');

    $method = $_POST['Method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not Exist";
    }

    function storeRequest(){
        $request = new requestController();

        echo $request->getStoreRequest($_SESSION['user_id'], $_POST['Address'], $_POST['Types'], $_POST['Color'], $_POST['Fabric'], $_POST['Message'], $_POST['paymentMethod'], $_POST['paymentTotalPrice']);
    }
    
    function getCustomerRequest(){
        $request = new requestController();
        
        echo $request->getCustomerRequest($_SESSION['user_id']);
    }
    
    function scheduleRepair(){
        $request = new requestController();
        
        echo $request->scheduleRepair($_SESSION['user_id'], $_POST['address']);
    }
?>