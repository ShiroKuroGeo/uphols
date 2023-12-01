<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Controllers/orderController.php');

    $method = $_POST['Method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not Exist";
    }

    function countAllOrder(){
        $order = new orderController();
        echo $order->getAllOrderFromCustomer();
    }
    
    function getSelectAllOrder(){
        $order = new orderController();

        echo $order->getSelectAllOrder();
    }

    function getSelectedCustomerOrder(){
        $order = new orderController();

        echo $order->getSelectedCustomerOrder($_POST['orderId']);
    }

    // function getUpdateQuantityInApproval(){
    //     $order = new orderController();

    //     echo $order->getUpdateQuantityInApproval($_POST['verify'], $_POST['customer_id'], $_POST['product_id']);
    // }

    function getAllApproveCustomersOrder(){
        $order = new orderController();

        echo $order->getAllApproveCustomersOrder($_POST['status'], $_POST['orderId'], $_POST['customer'], $_POST['gmail']);
    }

    function getUpdateQuantityInApproval(){
        $order = new orderController();

        echo $order->getUpdateQuantityInApproval($_POST['orderId'], $_POST['status'], $_POST['customerId']);
    }

    function getUpdateQuantityInDecline(){
        $order = new orderController();

        echo $order->getUpdateQuantityInDecline($_POST['orderId'], $_POST['status'], $_POST['customerId']);
    }

    function getOrderUserChart(){
        $order = new orderController();

        echo $order->getOrderUserChart();
    }

?>