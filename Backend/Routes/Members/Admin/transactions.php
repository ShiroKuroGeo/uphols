<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Controllers/transactionController.php');

    $method = $_POST['Method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not Exist";
    }

    function getOrderToTransaction(){
        $transaction = new transactionController();

        echo $transaction->getOrderToTransaction($_SESSION['user_id'], $_POST['status'], $_POST['customerId'], $_POST['orderId']);
    }
    
    function getSelectAll(){
        $transaction = new transactionController();

        echo $transaction->getSelectAll($_POST['customerId']);
    }
    
    function getSelectedUserTransaction(){
        $transaction = new transactionController();
        
        echo $transaction->getSelectedUserTransaction($_POST['customerId']);
    }
    
    function getDateDelivery(){
        $transaction = new transactionController();
        
        echo $transaction->getDateDelivery();
    }

?>