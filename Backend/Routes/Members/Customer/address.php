<?php

    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Controllers/addressController.php');

    $method = $_POST['Method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not Exist";
    }

    function storeAddress(){
        $add = new addressController();
        echo $add->storeAddress($_SESSION['user_id'], $_POST['Region'], $_POST['Province'], $_POST['City'], $_POST['Barangay'], $_POST['Street'], $_POST['Zip']);
    }

    function getUserAddress(){
        $add = new addressController();
        echo $add->getUserAddress($_SESSION['user_id']);
    }
    
    function deleteAddress(){
        $add = new addressController();

        echo $add->deleteAddress($_POST['id'],$_SESSION['user_id']);
    }
    
?>