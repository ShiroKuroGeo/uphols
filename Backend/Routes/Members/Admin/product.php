<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Controllers/productController.php');

    $method = $_POST['Method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not Exist";
    }

    function countAllProduct(){
        $product = new productController();
        echo $product->countAllProduct();
    }
    
    function selectAllProduct(){
        $product = new productController();
        echo $product->selectAllProduct();
    }
    
    function getStoreProduct(){
        $product = new productController();

        $location = $_SERVER['DOCUMENT_ROOT'] . "/Uphols/Assets/Images/";
        $profile = '';
        if(isset($_FILES['file']['name'])){
            
            $finalfile = $location . $_FILES["file"]['name'];
            if(move_uploaded_file($_FILES['file']['tmp_name'],$finalfile))
            {
                $profile = $_FILES["file"]['name'];
            }

        }

        echo $product->getStoreProduct($profile, $_POST['name'], $_POST['description'], $_POST['price'], $_POST['quantity']);
    }

    function showdDeleteProduct(){
        $product = new productController();

        echo $product->getShowdDeleteProduct($_POST['ProductId']);
    }

    function deleteSelectedProduct(){
        $product = new productController();

        echo $product->getDeleteSelectedProduct($_POST['ProductId']);
    }

    function selectlatestProduct(){
        $product = new productController();

        echo $product->selectlatestProduct();
    }

    function updateSelectedProduct(){
        $product = new productController();

        echo $product->updateSelectedProduct($_POST['ProductId'], $_POST['productName'], $_POST['productQuantity'], $_POST['productPrice'], $_POST['productStatus'], $_POST['productDescription']);
    } 

    function selectAllColumn(){
        $product = new productController();

        echo $product->selectAllColumn();
    } 
?>