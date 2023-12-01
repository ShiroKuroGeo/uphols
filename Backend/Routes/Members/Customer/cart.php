<?php

    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Controllers/cartController.php');

    $method = $_POST['Method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not Exist";
    }

    function storeCart(){
        $cart = new cartController();
        echo $cart->storeCart($_SESSION['user_id'], $_POST['product']);
    }

    function viewMyCart(){
        $cart = new cartController();
        echo $cart->viewMyCart($_SESSION['user_id']);
    }

    function totalPriceCart(){
        $cart = new cartController();
        echo $cart->totalPriceCart($_SESSION['user_id']);
    }
    
    function destroySelectedCart(){
        $cart = new cartController();
        echo $cart->destroySelectedCart($_POST['cart_id']);
    }
    
    function updateThisCartQuality(){
        $cart = new cartController();
        echo $cart->updateThisCartQuality($_SESSION['user_id'], $_POST['quantity'], $_POST['cart_id']);
    }

    function countSelectedCustomerCart(){
        $cart = new cartController();
        echo $cart->countSelectedCustomerCart($_SESSION['user_id']);
    }

    function storeAllSelectedCart(){
        $cart = new cartController();

        $cartIds = $_POST['cart_ids'];
        $arrays = $cart->storeAllSelectedCart($cartIds, $_SESSION['user_id']);

        echo json_encode($arrays, true);

    }

    function purchaseSelectedItem(){
        
        $cartIds = $_POST['cart_ids'];
        $address = $_POST['address'];

        $cart = new cartController();

        $arrays = $cart->purchaseSelectedItem($cartIds, $address, $_SESSION['user_id']);

        echo json_encode($arrays, true);
    }

?>