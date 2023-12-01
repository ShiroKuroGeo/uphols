<?php

    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Controllers/transactionController.php');

    $method = $_POST['Method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not Exist";
    }

    function AllCustomerTransaction(){
        $transaction = new transactionController();
        
        echo $transaction->AllCustomerTransaction($_SESSION['user_id']);
    }

    function seletedCustomerData(){
        $transaction = new transactionController();
        
        echo $transaction->seletedCustomerData($_POST['transac_id'], $_SESSION['user_id']);
    }

    function onApprove(){
        $transaction = new transactionController();
        
        echo $transaction->onApprove($_POST['transac_id']);
    }
    
?>