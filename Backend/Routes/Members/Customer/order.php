<?php

    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Controllers/orderController.php');

    $method = $_POST['Method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not Exist";
    }

    function countAllOrderFromCustomer(){
        $order = new orderController();

        echo $order->countAllOrderFromCustomer($_SESSION['user_id']);
    }

    function getCustomerOrder(){
        $order = new orderController();

        echo $order->getCustomerOrder($_SESSION['user_id']);
    }
    
    function requestCancel(){
        $order = new orderController();

        echo $order->getAllApproveCustomersOrder($_POST['status'], $_POST['orderId'], $_SESSION['user_id']);
    }

    function buyProduct(){
        $order = new orderController();

        echo $order->buyProduct($_POST['product'], $_POST['address'], $_POST['quantity'], $_SESSION['user_id']);
    }
?>