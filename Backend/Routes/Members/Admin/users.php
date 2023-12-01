<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Controllers/userController.php');

    $method = $_POST['Method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not Exist";
    }
    
    function allUsers(){
        $user = new userController();
        echo $user->allUser();
    }

    function userSelected(){
        $user = new userController();
        echo $user->userSelected($_POST['user_id']);
    }

    function latestCustomer(){
        $user = new userController();
        echo $user->latestCustomer();
    }
    
    function viewMyCart(){
        $cart = new userController();
        echo $cart->viewMyCart($_POST['user_id']);
    }

    function getCustomerOrder(){
        $order = new userController();
        echo $order->getCustomerOrder($_POST['user_id']);
    }

    function updateStatusOfUser(){
        $user = new userController();
        echo $user->updateStatus($_POST['status'], $_POST['user_id']);
    }

    function countAllUsers(){
        $user = new userController();
        echo $user->countAllUsers();
    }
    
?>