<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Controllers/productController.php');

    $method = $_POST['Method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not Exist";
    }
    
    function selectAllDisplayedProduct(){
        $product = new productController();
        echo $product->selectAllDisplayedProduct();
    }

    function selectAllRecommendedProduct(){
        $product = new productController();
        echo $product->selectAllRecommendedProduct();
    }

    function showToOrder(){
        $product = new productController();
        echo $product->showToOrder($_POST['product']);
    }
    
?>