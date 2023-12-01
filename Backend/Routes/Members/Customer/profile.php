<?php

    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Backend/Controllers/userController.php');

    $method = $_POST['Method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not Exist";
    }

    function customersInformation(){
        $user = new userController();
        echo $user->customersInformation($_SESSION['user_id']);
    }
    
    function updateInformation(){
        $user = new userController();
        echo $user->updateInformation($_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['username'],$_POST['phone'],$_SESSION['user_id']);
    }

    function changeProfile(){
        $user = new userController();

        $location = $_SERVER['DOCUMENT_ROOT'] . "/Uphols/Assets/Images/";
        $profile = '';
        if(isset($_FILES['file']['name'])){
            $finalfile = $location . $_FILES["file"]['name'];
            if(move_uploaded_file($_FILES['file']['tmp_name'], $finalfile))
            {
                $profile = $_FILES["file"]['name'];
            }
            if($profile == null){
                $profile = "DefualtProfile.png";
            }
        }
        echo $user->changeProfile($_SESSION['user_id'], $profile);
    }

    function checkOldPassword(){
        $user = new userController();

        echo $user->checkOldPassword($_POST['oldPass'], $_SESSION['user_id']);
    }

    function countAllMyTotalRequest(){
        $user = new userController();

        echo $user->countAllMyTotalRequest($_SESSION['user_id']);
    }
    
    function changePassword(){
        $user = new userController();

        echo $user->changePassword($_POST['newPassword'], $_POST['oldPassword'], $_SESSION['user_id']);
    }
